<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;



class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    protected $fillable=[
        'name',
        'user_id',
        'small_desc',
        'big_desc',
        'price',
        'category',
        'status',
    ];
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    public function likedUsers() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'favorites');
    }



    public function favorites() : HasMany
    {
        return $this->hasMany(Favorite::class);
    }



    public function addedToCard() : BelongsToMany
    {
        return $this->belongsToMany(User::class , 'cards');
    }
    public function reviews() : HasMany
    {
        return $this->hasMany(Reviews::class);
    }
}





   


