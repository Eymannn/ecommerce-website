<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;


class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userable_id',
        'userable_type',
        
        
    ];
    protected $casts = [
        'achievements' => 'array',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userable(): MorphTo
    {
        return  $this->morphTo();
    }


    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function badges(): HasMany
    {
        return $this->hasMany(Badge::class);
    }


    public function likedProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }




    public function productCard(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cards');
    }

    // protected function getBadgeAttribute()
    // {
    //     return match ($this->status) {
    //         'waiting' => ['bg' => 'bg-yellow-300' , 'label' => 'waiting'],
    //         'verified' => ['bg' => 'bg-green-300' , 'label' => 'verified'],
    //         'banned' => ['bg' => 'bg-red-700' , 'label' => 'banned'],
    //         default => ['bg' => 'bg-green-300' , 'label' => 'waiting']
    //     };
    // }

    public function reviews() : HasMany
    {
        return $this->hasMany(Reviews::class);
    }

    public static function getTopByProductCount($limit)
    {
        return self::withCount('products')->orderBy('products_count' , 'desc')->limit($limit);
    }


    public static function clearAllAchievements()
    {
        self::whereNotNull('achievements')->update([ 'achievements' => null ]);
    }
}
