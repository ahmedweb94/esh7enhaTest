<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAdminRequest;
use App\Notifications\UserStatusMail;
use App\Repository\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    protected $adminRepo;
    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo=$adminRepo;
    }

    public function index()
    {
        $admins = $this->adminRepo->with('roles')->get();
        return view('admin.Admin.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.Admin.create', compact( 'roles'));
    }

    public function store(AddAdminRequest $request)
    {
        $admin = $this->adminRepo->create($request->validated());
        $admin->assignRole($request->roles);
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('admin.index')],200);
    }

    public function edit($id)
    {
        $admin=$this->adminRepo->with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin.Admin.create', compact( 'roles','admin'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'name' => 'required|string|min:3',
            'password' => 'nullable|min:6|max:32|confirmed',
            'roles' => 'required|array',
            'mobile' => 'required|digits_between:5,25',
        ]);
        $data = $request->except('_token', 'roles', 'password');
        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }
        $admin = $this->adminRepo->update($id, $data);
        $admin->syncRoles($request->roles);
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('admin.index')],200);
    }

    public function destroy($id)
    {
        if ($this->adminRepo->getById($id)) {
            $this->adminRepo->delete($id);
            return response(['status'=>200,'message'=>trans('admin.deleted')],200);
        }
        return response(['status'=>400,'message'=>trans('admin.not_found')],200);
    }

    public function status($id, Request $request)
    {
        $user = $this->adminRepo->getById($id);
        $reason = $request->reason;
        $data['active'] = $user->active==1?0:1;
        $data['reason'] = $reason;
        $this->adminRepo->update($id, $data);
        $this->sendMail($user, $data['active'], $reason);
        return response(['status'=>200,'message'=>trans('admin.updated'),'item'=>$data['active']],200);
    }

    public function sendMail($user, $status, $reason = null)
    {
        if ($status == 1) {
            $data['message'] = 'Your Account Is Activated';
            $data['footer'] = 'Login Now';
        } elseif ($status == 0) {
            $data['message'] = 'Your Account Is Disabled From Admin Because Of ' . $reason;
            $data['footer'] = 'Please Contact The Admin';
        }
        Notification::send($user, new UserStatusMail($data));
    }

    public function profile()
    {
        $admin = $this->adminRepo
            ->with('roles')
            ->find(Auth::guard('admin')->id());
        return view('admin.Admin.show', compact('admin'));
    }

}
