<?php

namespace App\Http\Controllers;
use App\Models\Wishlist;
use App\Models\Product;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
 //add to wishlist

 public function wish(Request $request)  {
    $product_id=$request['product_id'];
    $user_id=$request['user_id'];

    Wishlist::create([
        'user_id'=>$user_id,
        'product_id'=>$product_id
    ]);
    return response()->json(['message'=>'added to waitlist'], 200);
    
   }

   // show

   public function get($id) {
    $get=Wishlist::where('user_id','=',$id)->pluck('product_id');
    //var_dump($get);
    $pro=Product::wherein('id',$get)->get();
    return response()->json(['data'=>$pro], 200);
   }
}
