<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'postal_code',
        'city',
        'address'
    ];

    public function user() : MorphOne
    {
        return $this->morphOne(User::class , 'userable');
    }
}