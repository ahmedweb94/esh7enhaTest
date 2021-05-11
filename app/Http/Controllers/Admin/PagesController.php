<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditPageRequest;
use App\Http\Requests\Front\ContactReplyRequest;
use App\Mail\ReplyContactMail;
use App\Repository\ContactUsRepository;
use App\Repository\PageRepository;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    private $pageRepo;
    private $contactRepo;

    public function __construct( PageRepository $pageRepo, ContactUsRepository $contactRepo)
    {
        $this->pageRepo = $pageRepo;
        $this->contactRepo = $contactRepo;
    }

    public function index()
    {
        $pages = $this->pageRepo->whereIn('index', ['about_us', 'terms'])->get();
        return view('admin.page.index', compact('pages'));
    }

    public function edit($id)
    {
        $page=$this->pageRepo->getById($id);
        return view('admin.page.edit', compact('page'));
    }

    public function update($id,EditPageRequest $request)
    {
        $this->pageRepo->update($id,$request->validated());
        return response(['status'=>200,'message'=>trans('admin.updated'),'url'=>route('page.index')],200);
    }

    public function contact()
    {
        $contact = $this->contactRepo->orderBy('id', 'desc')->get();
        return view('admin.ContactUs.index', compact('contact'));
    }

    public function viewMessage($id)
    {
        $contact = $this->contactRepo->getById($id);
        if ($contact->read_at == null) {
            $this->contactRepo->update($id, ['read_at' =>now()]);
        }
       return view('admin.ContactUs.show', compact('contact'));
    }

    public function delete($id)
    {
        $this->contactRepo->delete($id);
        return response(['status'=>200,'message'=>trans('admin.deleted')],200);
    }

    public function reply($id, ContactReplyRequest $request)
    {
        $contact = $this->contactRepo->update($id, $request->except('_token'));
        Mail::to($contact->email)->send(new ReplyContactMail($contact));
        return response(['status'=>200,'message'=>trans('admin.mail_send')],200);
    }

}
