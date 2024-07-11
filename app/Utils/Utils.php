<?php

namespace App\Utils;

use App\Enums\UserableType;

class Utils{

    public static function isSeeler() : bool{
        return auth()->user()->userable_type === UserableType::SELLER;
    }


    public static function isCustomer() : bool{
        return auth()->user()->userable_type === UserableType::CUSTOMER;
    }
}