<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Mail\OrderMail;
use App\Mail\PaymentUserMail;
use App\Mail\AdminConfirmMail;
use App\Models\Cart;
use App\Models\notification;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
   public  function add(Request $request,$ref,$tran)  {
        $request->validate([
            'description'=>'required',
            'state'=>'required|string',
            'address'=>'required'
            
        ]);
      $pr=$request['product_id'];
      $rf=implode(" ",$pr);
      $pt=$request['stock'];
      $rr=implode(" ",$pt);
      
      Cart::wherein('product_id',$pr)->delete();
        Order::create([
            'user_id'=>auth::user()->id,
            'product_ids'=>$rf,
            'day'=>$request['day'],
            'description'=>$request['description'],
            'state'=>$request['state'],
            'address'=>$request['address'],
            'stock'=>$rr,
            'user_name'=>auth::user()->name,
            'status'=>'Pending',
            'total'=>$request['SubTotal']+  $request['delivery']      
        ]);  
      Payment::create([
        'Amount'=>$request['SubTotal']+  $request['delivery'],
        'PaymentReference'=>$ref,
        'TransactioonID'=>$tran
  
      ]);
       $subTotal=$request['SubTotal'];
       $delivery=$request['delivery'];
  
        $Shopped=Product::whereIn('id',$pr)->get();

        $rg=['shopped'=>$Shopped,'stock'=>$pt,'sub'=>$subTotal,'del'=>$delivery,'name'=>auth::user()->name];
        
        $user = Auth::user();

        $user->load('orders');
        $user->load('carts');
      

       $owners= Product::wherein('id',$pr)->pluck('user_id');
       $owner=User::wherein('id',$owners)->get();
       foreach ($owner as $ow) {
        Mail::to($ow['email'])->send(new AdminConfirmMail($rg));
       }
        
        
        Mail::to(auth::user()->email)->send(new OrderMail($rg));

        Mail::to(auth::user()->email)->send(new PaymentUserMail($rg));

        Mail::to('okoloemeka47@gmail.com')->send(new AdminConfirmMail($rg));
        
        //add to notice;

notification::create([
  'type_id'=>$user->id,
  'notice'=>"A new Order Added",
  'type'=>'Order',
  'view'=>'no'
]);
notification::create([
  'type_id'=>$user->id,
  'notice'=>"Payment confirmed",
  'type'=>'Payment',
  'view'=>'no'
]);

         
        return response()->json(['message'=>'Order Recieved','user'=>$user], 200);
      
        
    }

    //showing orders

    public function ordersAll()  {
      $orders=Order::orderby('order_id','desc')->get();
      return response()->json($orders, 200);
    }
    public function Sellerorders($id)  {
      $orders=Order::where('user_id','=',$id)->orderby('order_id','desc')->get();
      return response()->json($orders, 200);
    }

    //get one order
    public function orderGet($id)  {
      $order=Order::where('order_id','=',$id)->get();
     
    $user_id= $order[0]['user_id'];

    $user=User::where('id','=',$user_id)->get();
    $pr= explode(' ',$order[0]['product_ids']);
    $pt= explode(' ',$order[0]['stock']);
    $Shopped=Product::whereIn('id',$pr)->get();

      return response()->json(['order'=>$order,'user'=>$user,'shop'=>$Shopped,'pt'=>$pt], 200);
    }


  public function editOrderStat(Request $request, $id){

    $request->validate([
      'status'=>'required'
    ]);

    $check=Order::where('order_id','=',$id);
    $check->update([
      'status'=>$request['status']
    ]);
    return response()->json(['message'=>"Upated"], 200);
  }

}
