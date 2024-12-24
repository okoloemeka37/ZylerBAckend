<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','stock','product_id'
    ];

/**
 * Get the user that owns the Cart
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}

}
