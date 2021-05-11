<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 7/22/2020
 * Time: 11:12 AM
 */

namespace App\Helper;


class RandomCode
{
    public static function getToken($length = 10)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i = 0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max - 1)];
        }
        return $token;
    }
}
