<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 10/26/2019
 * Time: 1:38 PM
 */

namespace App\Helper;


class UsersType
{
    const Client = 0;
    const Driver = 1;

    static function getStatus($status)
    {
        $arr = array(
            '0' => 'Client',
            '1' => 'Driver',
        );
        return $arr[$status];
    }
}
