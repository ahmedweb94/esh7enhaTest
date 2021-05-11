<?php
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 10/26/2019
 * Time: 1:38 PM
 */

namespace App\Helper;


class OrderStatus
{
    const newOrder = 'new';
    const accepted = 'accepted';
    const delivering = 'delivering';
    const delivered = 'delivered';
    const admin_cancel = 'admin_cancel';
    const user_cancel = 'user_cancel';

    const arr=array(
        'new' => 'new',
        'accepted' => 'accepted',
        'delivering' => 'delivering',
        'delivered' => 'delivered',
        'admin_cancel' => 'admin_cancel',
        'user_cancel' => 'user_cancel',
    );
    static function getStatus($status)
    {
        $arr = array(
            'new' => 'new',
            'accepted' => 'accepted',
            'delivering' => 'delivering',
            'delivered' => 'delivered',
            'admin_cancel' => 'admin_cancel',
            'user_cancel' => 'user_cancel',
        );
        return $arr[$status];
    }
}
