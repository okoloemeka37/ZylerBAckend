<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
   protected $fillable=[
    'name','Description','price','tag','stock','gender','category','image'
   ];

   function cart(){
    return $this->hasMany(Cart::class);
   }
   public function wishlists(){
    return $this->hasMany(Wishlist::class);
 }
}
