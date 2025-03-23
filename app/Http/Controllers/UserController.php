<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
  public function get() {
    $users=User::where('status','!=','Admin')->orderBy('id','desc')->get();
    return response()->json($users, 200);
  }

  public function deleteUser(Request $request){
    $users = $request->input('data'); // Get the array from request

    foreach ($users as $user) {
        // Example: Deleting user by ID
        User::where('id', $user['id'])->delete();
    }
    $users=User::where('status','!=','Admin')->orderBy('id','desc')->get();
    return response()->json(['message' => 'User deleted successfully','user'=>$users,'status'=>200]);
}
public function getSellers($id){
  $user=User::where('id','=',$id)->first();
  $user->load('products');
  $review=DB::table('reviews')
  ->join('users','reviews.cus_id','=','users.id')
  ->where('reviews.user_id',$id)
  ->select('reviews.comment','reviews.cus_id','reviews.user_id' ,'reviews.id','reviews.rating','reviews.created_at','users.image','users.name')
  ->get();
  
  return response()->json(['user'=>$user,'review'=>$review,'status'=>200]);
}

public function addReview(Request $request){
$request->validate([
'comment'=>'required'
]);
Review::create([
  'user_id'=>$request->user_id,
  'cus_id'=>$request->cus_id,
  'comment'=>$request->comment,
  'rating'=>$request->rating
]);

$review=DB::table('reviews')
->join('users','reviews.cus_id','=','users.id')
->where('reviews.user_id',$request->user_id)
->select('reviews.comment','reviews.cus_id','reviews.user_id','reviews.id','reviews.rating','reviews.created_at','users.image','users.name')
->get();

return response()->json(['message'=>'Review Added','review'=>$review,'status'=>200]);

}




public function EditRating(Request $request ,$id){
  
  $request->validate([
    'rating' => 'required|integer|min:1|max:5',
    'comment' => 'required|string',
]);
$review=Review::findOrFail($id);
$review->update([
  'rating' => $request->rating,
  'comment' => $request->comment,
]);

$Allreview=DB::table('reviews')
->join('users','reviews.cus_id','=','users.id')
->where('reviews.user_id',$request->user_id)
->select('reviews.comment','reviews.rating' ,'reviews.user_id','reviews.id','reviews.created_at','users.image','reviews.cus_id','users.name')
->get();

return response()->json(['data'=>$Allreview,'status'=>200]);
}

public function DeleteReview(Request $request){
$review=Review::destroy($request->id);
$Allreview=DB::table('reviews')
->join('users','reviews.cus_id','=','users.id')
->where('reviews.user_id',$request->user_id)
->select('reviews.comment','reviews.rating' ,'reviews.user_id','reviews.id','reviews.created_at','users.image','reviews.cus_id','users.name')
->get();

return response()->json(['data'=>$Allreview,'status'=>200]);
}
}

