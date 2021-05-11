<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles=Role::all();
        return view('admin.Roles.index',compact('roles'));
    }

    public function create()
    {
        $roles=Role::all();
        $permissions=Permission::all();
        return view('admin.Roles.create',compact('roles','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'permissions'=>'required',
        ]);
        $role=Role::create(['name'=>$request->name,'guard_name'=>'admin']);
        $role->syncPermissions($request->permissions);
        return response(['status'=>200,'message'=>trans('admin.created'),'url'=>route('role.index')],200);
    }

    public function edit($id)
    {
        $role=Role::findById($id);
        $permissions=Permission::all();
        $rolePermissions=$role->permissions()->pluck('id')->toArray();
        return view('admin.Roles.create',compact('role','rolePermissions','permissions'));
    }

    public function update($id,Request $request)
    {
        $role=Role::findById($id);
        $data['name']=$request->name;
        $role->update($data);
        $role->syncPermissions($request->permissions);
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('role.index')],200);
    }

    public function delete($id)
    {
        Role::destroy($id);
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
    }

}
