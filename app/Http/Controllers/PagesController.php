<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\ContactUsRequest;
use App\Repository\ContactUsRepository;
use App\Repository\PageRepository;

class PagesController extends Controller
{

    protected $pageRepo;
    protected $contactRepo;

    public function __construct(PageRepository $pageRepo,ContactUsRepository $contactRepo)
    {
        $this->pageRepo=$pageRepo;
        $this->contactRepo=$contactRepo;
    }

    public function aboutus()
    {
        $item=$this->pageRepo->where('index','about_us')->first();
        return view('front.pages.aboutus',compact('item'));
    }

    public function terms()
    {
        $item=$this->pageRepo->where('index','terms')->first();
        return view('front.pages.terms',compact('item'));
    }

    public function contact()
    {
        return view('front.pages.contact');
    }

    public function postContact(ContactUsRequest $request)
    {
        $this->contactRepo->create($request->validated());
        return response(['status'=>200,'message'=>trans('admin.mail_send')],200);
    }



}
