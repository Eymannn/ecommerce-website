<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public static function rules() {
        return [
            "PRODUCT_TOP_10" => [
                'users' => User::getTopByProductCount(10),
                'badges' => ['top_10'],
            ],
            "PRODUCT_TOP_3" => [
                'users' => User::getTopByProductCount(3),
                'badges' => ['top_10', 'top_3'],
            ],
            "PRODUCT_TOP_1" => [
                'users' => User::getTopByProductCount(1),
                'badges' => ['top_10', 'top_3', 'seller_of_the_month'],
            ],
            "VERIFIED" => [
                "users" => User::whereStatus('verified'),
                'badges' => ['verified']
            ]
        ];
    }

    use HasFactory;
}
