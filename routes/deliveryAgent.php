<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryAgent\DeliveryAgentCotroller;
use App\Http\Controllers\DeliveryAgent\Order\Chat\ChatController;
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

     Route::get('/order/active', [OrderController::class, 'getActiveOrder']);

     Route::get('/order/new/details', [OrderController::class, 'getNewOrderDetails']);

     Route::put('/order/new/accept', [OrderController::class, 'acceptNewOrder']);

     Route::get('/order/new/show/store/code', [OrderController::class, 'showStoreCode']);

     Route::get('/order/new/store/location', [OrderController::class, 'getNewOrderStoreLocation']);

     Route::put('/order/start/drive', [OrderController::class, 'startDrive']);

     Route::get('/order/details/finish', [OrderController::class, 'detailsFinish']);

     //================================== Send Message Route ========================

    Route::get('/order/chat/user/message' , [ChatController::class , 'getUserMessage']);
    
    Route::post('/order/chat/send/message', [ChatController::class, 'sendMessage']);

});