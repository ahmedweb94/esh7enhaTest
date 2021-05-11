<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditSocialPageRequest;
use App\Repository\SettingRepository;
use App\Repository\SocialRepository;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    protected $settingRepo;
    protected $socialRepo;

    public function __construct(SettingRepository $settingRepo,SocialRepository $socialRepo)
    {
        $this->settingRepo = $settingRepo;
        $this->socialRepo = $socialRepo;
    }

    public function index()
    {
        $settings = $this->settingRepo->getAll();
        return view('admin.setting.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = $this->settingRepo->getById($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update($id, Request $request)
    {
        $setting = $this->settingRepo->update($id, $request->except('_token'));
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('setting.index')],200);
    }

    public function social()
    {
        $pages = $this->socialRepo->where('status',1)->get();
        return view('admin.social.index', compact('pages'));
    }

    public function editSocial($id)
    {
        $page = $this->socialRepo->getById($id);
        return view('admin.social.edit', compact('page'));
    }

    public function updateSocial($id, EditSocialPageRequest $request)
    {
        $this->socialRepo->update( $id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('social.index')],200);
    }

}
