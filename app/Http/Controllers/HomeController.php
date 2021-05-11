<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{



    public function index()
    {
        $products=$this->productRepo->where(['status'=>1])->orderBy('id','desc')->limit(9)->get();
        $cat=$this->catRepo->where('status',1)->whereHas('products',function ($q){
            $q->where(['status'=>1]);
        })->orderBy('sort')->orderBy('id')->limit(8)->get();
        return view('front.home',compact('products','cat'));
    }

    public function lang($lang)
    {
        if (in_array($lang, ['ar', 'en','ur'])) {
            if (session()->has('lang')) {
                session()->forget('lang');
            }
            session()->put('lang', $lang);
            if(auth()->guard('admin')->check()) {
                auth()->guard('admin')->user()->lang = $lang;
                auth()->guard('admin')->user()->save();
            }
            if (auth()->check()){
                auth()->user()->lang = $lang;
                auth()->user()->save();
            }
            app()->setLocale($lang);
        } else {
            if (session()->has('lang')) {
                session()->forget('lang');
            }
           if(auth()->guard('admin')->check()){
               $la=auth()->guard('admin')->user()->lang;
           }elseif(auth()->check()){
               $la=auth()->user()->lang;
           }else{
               $la='ar';
           }
            session()->put('lang', $la);
            app()->setLocale($la);
        }
        return back();
    }

    public function adminHome()
    {
        $users=User::count();
        return view('admin.home.index',compact('users'));
    }

}
