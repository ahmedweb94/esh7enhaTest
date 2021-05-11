<?php

namespace App\Helper;
/**
 * Created by PhpStorm.
 * User: Ahmed
 * Date: 4/14/2020
 * Time: 4:25 PM
 */
Class ContactUsType
{
    const Order = 0;
    const Compliant = 1;
    const Suggest = 2;
    const Other = 3;
    const AllTypes = array(
        '0' => 'Order',
        '1' => 'Compliant',
        '2' => 'Suggest',
        '3' => 'Other',
    );

    static function getType($status)
    {
        $arr = array(
            '0' => 'Order',
            '1' => 'Compliant',
            '2' => 'Suggest',
            '3' => 'Other',
        );
        return $arr[$status];
    }

}
