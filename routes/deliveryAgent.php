<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryAgent\DeliveryAgentCotroller;
use App\Http\Controllers\DeliveryAgent\Order\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| deliveryAgent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register deliveryAgent routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "deliveryAgent" middleware group. Make something great!
|
*/

Route::middleware(['deliveryAgent', 'auth:deliveryAgent'])->group(function () {

     //delivery Agent Status 

     Route::get('/status', [DeliveryAgentCotroller::class, 'get_count_order']);

     //delivery Agent new order 


     Route::get('/order/new', [OrderController::class, 'getNewOrder']);

     Route::get('/order/new/details', [OrderController::class, 'getNewOrderDetails']);



});