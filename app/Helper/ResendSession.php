<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/27/2021
 * Time: 3:12 PM
 */

namespace App\Helper;


class ResendSession
{

    public static function check()
    {
        if(session()->has('resend')){
            if(session('resend')==1){
                session()->put('resend',2);
            }elseif(session('resend')==2){
                session()->put('resend',3);
            }
        }else{
            session()->put('resend',1);
        }
    }
}
