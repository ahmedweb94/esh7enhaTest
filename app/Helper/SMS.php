<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/27/2021
 * Time: 11:50 AM
 */

namespace App\Helper;


class SMS
{

    public static function send($mobile,$message)
    {
        $mobile=preg_replace("/^0/", "966", $mobile);
//        $mobile='966'.$mobile;
        $appsid=env('SMS_appsid');
        $sender=env('SMS_sender');
        $msg=urlencode($message);
        $to=$mobile;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://basic.unifonic.com/wrapper/sendSMS.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"appsid=$appsid&msg=$msg&to=$to&sender=$sender&baseEncode=false&encoding=GSM7");
        curl_setopt($ch, CURLOPT_USERPWD, env('SMS_username') . ':' . env('SMS_password'));

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

}
