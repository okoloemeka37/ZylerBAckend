<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [Login::class, 'login']);
Route::post('/register', [Login::class, 'register']);




Route::middleware('auth:sanctum')->group(function (){

    Route::post("/AddProduct",[ProductController::class, 'store']);

   Route::get("/GetProduct/{tag}",[ProductController::class, 'getProduct']) ; 
   
Route::get("/ViewProduct/{id}",[ProductController::class, 'show']);

Route::put("/UpdateProduct/{id}",[ProductController::class, 'Update']);

Route::delete("/DeleteProduct/{id}",[ProductController::class, 'destroy']);
  

Route::get("/setCat/{type}",[ProductController::class, 'setCat']);

Route::get("/getPro/{type}",[ProductController::class, 'indexGet']);

Route::get("/getRelated/{cat}/{id}",[ProductController::class, 'relatedPro']);


Route::post('/logout', [Login::class, 'logout']);
});



