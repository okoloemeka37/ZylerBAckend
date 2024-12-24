<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','product_ids','day','description','state','address','stock','user_name','status','total'
    ];

    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
public function product(): BelongsTo
{
    return $this->belongsTo(Product::class);
}


}
