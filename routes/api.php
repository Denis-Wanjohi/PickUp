<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RidesController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){
     Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/home',[HomeController::class,'index']);
    // SHOPPING
    Route::get('/cartItems',[ProductsController::class,'cartItems']);
    Route::post('/addToCart',[ProductsController::class,'addCart']);
    Route::post('/editProduct',[ProductsController::class,'editProduct']);
    Route::post('/editCart',[ProductsController::class,'editCart']);
    Route::post('/removeFromCart',[ProductsController::class,'removeFromCart']);
    Route::post('/riderRequest',[ProductsController::class,'riderRequest']);
    Route::post('/continueProcess',[ProductsController::class,'continueProcess']);
    Route::post('/setDestination',[ProductsController::class,'setDestination']);
    Route::post('/setNumber',[ProductsController::class,'setNumber']);
    Route::post('/confirmationCode',[ProductsController::class,'confirmationCode']);

    // RIDE(TRANSPORT)
    Route::post('/rideRequest',[RidesController::class,'create']);
    Route::post('/rideConfirmation',[RidesController::class,'store']);
    Route::post('/ride',[RidesController::class,'completion']);

    // RIDE(PACKAGE DELIVERY)
    Route::post('/packageRider',[PackagesController::class,'create']);
    Route::post('/packageConfirmation',[PackagesController::class,'packageConfirmation']);
    Route::post('/setPackageNumber',[PackagesController::class,'packageNumber']);
    Route::post('/confirmationPackageCode',[PackagesController::class,'packageMpesaCode']);
    
});
   
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);