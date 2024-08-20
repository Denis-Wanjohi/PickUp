<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RidesController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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
   Route::post('/order',[ProductsController::class,'order']);
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
   Route::post('/delivery',[PackagesController::class,'create']);
   Route::post('/packageConfirmation',[PackagesController::class,'packageConfirmation']);
   Route::post('/setPackageNumber',[PackagesController::class,'packageNumber']);
   Route::post('/confirmationPackageCode',[PackagesController::class,'packageMpesaCode']);

   // ADMIN
   Route::post('/registerRider',[RiderController::class,'register']);
   
});

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');