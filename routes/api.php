<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// "https:\/\/raw.githubusercontent.com\/okoloemeka37\/ImageHolder\/main\/uploads\/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/AddProduct",[ProductController::class, 'store']);


Route::post('/login', [Login::class, 'login']);
Route::post('/register', [Login::class, 'register']);
Route::post('/passReset',[Login::class,'passReset']);
Route::post('/TokenConfirm',[Login::class,'TokenConfirm']);

Route::put('/ChangePassword{id}', [Login::class, 'CP']);

//getalllsum
Route::get("/getSum",[ProductController::class, 'getSum']);



Route::get("/getIndexPro/{type}",[ProductController::class, 'indexGet']);

Route::get("/getIndex",[ProductController::class, 'getIndex']);
Route::get("/getTagPro/{type}",[ProductController::class, 'getTagPro']);

Route::get("/getRelated/{cat}/{id}",[ProductController::class, 'relatedPro']);
Route::get("/ViewProduct/{id}",[ProductController::class, 'show']);


//getting sellers
Route::get("/getSellers/{id}",[UserController::class, 'getSellers']);




Route::middleware('auth:sanctum')->group(function (){

    //get sellers product;
    Route::get("/getSellerProduct/{id}",[ProductController::class, 'getSellerProduct']);

//add reviews and rating
Route::post("/addReview",[UserController::class,"addReview"]);

//Editing Review
Route::put("/EditRating/{id}",[UserController::class,"EditRating"]);
//Deleting Review
Route::post("/DeleteReview",[UserController::class,'DeleteReview']);

//edit user
Route::post('/Update{id}', [Login::class, 'Update']);
Route::get('/Edit', [Login::class, 'Edit']);

//change password



    

   Route::get("/GetProduct/{tag}",[ProductController::class, 'getProduct']) ; 
   


Route::put("/UpdateProduct/{id}",[ProductController::class, 'Update']);

Route::delete("/DeleteProduct/{id}",[ProductController::class, 'destroy']);
Route::post("/DeleteUser",[UserController::class, 'deleteUser']);

Route::get("/setCat/{type}",[ProductController::class, 'setCat']);





//Add To Cart
Route::post('/AddCart', [CartController::class,'AddCart']);

Route::delete("/delCart/{id}",[CartController::class, 'delCart']);

//get From cart
Route::get('/GetCart{user_id}',[CartController::class,'GetCart']);

Route::get("/checkoutBill{user_id}",[CartController::class,'checkoutBill']);

Route::post('/logout', [Login::class, 'logout']);

//getstate
Route::get('/getState', [ProductController::class,'getState']);

//order
Route::post("/AddOrder/{ref}/{tran}",[OrderController::class,'add']);
});


//show all orders

Route::get("/ordersAll",[OrderController::class,'ordersAll']);


//get one order
Route::get("/orderGet{id}",[OrderController::class,'orderGet']);
Route::put("/editOrderStat{id}",[OrderController::class,'editOrderStat']);


//add to wishlist
Route::post('/addWish', [WishlistController::class,'wish']);
Route::get('/getWish{id}', [WishlistController::class,'get']);

//notification
Route::get('/getNote', [NotificationController::class,'show']);

//get users
Route::get("/getUser",[UserController::class,'get']);
Route::post('/lifeSearch',[ProductController::class,'lifeSearch']);



//payment

Route::get('/retrieveRevenue/{start}/{end}', [PaymentController::class, 'retrieve']);