<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id'];

    function user(): BelongsTo {
            return $this->belongsTo(User::class); 
    }
    function product() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}

