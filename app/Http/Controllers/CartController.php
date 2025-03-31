<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddCart(Request $request){
        $request->validate([
            'user_id'=>'required',
            'product_id'=>'required',
            'stock'=>'required'
        ]);
        try {
            $check=Cart::where('user_id','=',$request['user_id'])->where('product_id','=',$request['product_id'])->get();
            if (count($check) !== 0) {
                return $check;
            }else{
                    Cart::create([
            'user_id'=>$request['user_id'],
            'product_id'=>$request['product_id'],
            'stock'=>$request['stock'],
        ]);
            }
            $user = Auth::user();

            $user->load('orders');
            $user->load('carts');
return response()->json(['message'=>'Product Added To Cart Successfully','user'=>$user], 200);

        } catch (\Throwable $th) {
            throw $th;
            return response()->json(['error'=>$th], 500);
        }

    }
    public function GetCart($user_id)  {

            $ids=Cart::where('user_id','=',$user_id)->pluck('product_id');

       $cart=Product::whereIn('id',$ids)->with('cart')->get();
        return $cart;
    }

    public function checkoutBill($user_id)  {
        $ids=Cart::where('user_id','=',$user_id)->pluck('product_id');
      


        $cart=Product::whereIn('id',$ids)->with('cart')->get();

   
        return response()->json(['cart'=>$cart,'product_ids'=>$ids], 200);;
    }
    


    function delCart($id)  {
        $pro=Cart::where('product_id','=',$id);
        
     if ($pro->delete()) {
        
            $check=Cart::where('user_id','=',Auth::user()->id)->get();
            
            $user = Auth::user();
            $user->load('orders');
            $user->load('carts');
            $user->load('products');
            $user->load('review');
            return response()->json(['message'=>'Product Removed Successfully','user'=>$user,'cart'=>$check], 200);
    }
}
}
