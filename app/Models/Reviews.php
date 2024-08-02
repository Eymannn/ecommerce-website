<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Reviews extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'content',
        'rating',
        'user_id',
        'product_id',
        
        // other fillable attributes
    ];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
