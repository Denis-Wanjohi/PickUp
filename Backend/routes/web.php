<?php

use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MpesaTransactions;
use App\Models\MpesaTransaction;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
});



Route::get('/sms',[MpesaTransactions::class,'index']);
Route::post('/sms1',[MpesaTransactions::class,'index1']);
Route::post('/mpesa',[MpesaTransactions::class,'pay']);