<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable=[
        'name',
        'user_id',
        'small_desc',
        'big_desc',
        'price',
        'category'
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likedUsers() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'favorites');
    }
}





   


