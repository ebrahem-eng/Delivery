<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DiscountCode\DiscountCodeController;
use App\Http\Controllers\User\Location\LocationController;
use App\Http\Controllers\User\Order\Chat\ChatController;
use App\Http\Controllers\User\Order\OrderController;
use App\Http\Controllers\User\Product\ProductController;
use App\Http\Controllers\User\Store\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register user routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "user" middleware group. Make something great!
|
*/

// Route::group([
//     'middleware' => 'userD' // Use multiple guards
// ], function ($router) {

Route::middleware(['userD', 'auth:userD'])->group(function () {

    //=================================order ========================

    //get order count 

    Route::get('/order/count', [OrderController::class, 'get_count_order']);

    //store order 


    Route::post('/order/store', [OrderController::class, 'storeOrder']);


    // ================================= product =======================

    //Get Product Store 

    Route::get('/product/store', [ProductController::class, 'getProductStore']);

    //Get Product Store search

    Route::get('/product/search', [ProductController::class, 'getProductSearch']);


    // Get Product Resturant Catigory

    Route::get('/product/catigory', [ProductController::class, 'getProductCatigory']);


    //get trending product

    Route::get('/product/trende', [ProductController::class, 'get_trending_product']);

    //get new product

    Route::get('/product/new', [ProductController::class, 'get_new_product']);


    // =============================== store ===============================

    // get store

    Route::get('/stores', [StoreController::class, 'getStore']);

    // get resturant search

    Route::get('/store/search', [StoreController::class, 'getStoreSearch']);

    //get Store Catigory

    Route::get('/store/catigory', [StoreController::class, 'getStoreCatigory']);

    //get type store

    Route::get('/store/type', [StoreController::class, 'get_store_type']);

    //get distance between user and store

    Route::get('/store/distance', [StoreController::class, 'CalculateDistance']);

    //get delivery fee for store

    Route::get('/store/deliveryFee', [StoreController::class, 'CalculateDeliveryFee']);

    //========================= Location ============================

    //get all location for user

    Route::get('/location/user', [LocationController::class, 'getUserlocations']);

    //get location by id 

    Route::get('/location/user/id', [LocationController::class, 'getLocationByID']);

    //store location in database

    Route::post('/location/store', [LocationController::class, 'storeLocation']);

    //update location

    Route::put('/location/update', [LocationController::class, 'updateLocation']);

    //delete location

    Route::delete('/location/delete', [LocationController::class, 'deleteLocation']);

    //=============================== Discount Code ============================

    Route::get('/discount/code/ByName', [DiscountCodeController::class, 'getDiscountCodeByName']);

    Route::get('/discount/code/ByIDs', [DiscountCodeController::class, 'getDiscountCodeByIDs']);


    //=============================== Active Order Route ============================

    Route::get('/order/active', [OrderController::class, 'getActiveOrder']);

    Route::get('/order/active/details', [OrderController::class, 'getActiveOrderDetails']);

    Route::put('/order/active/track/order', [OrderController::class, 'trackActiveOrder']);

    Route::get('/order/active/get/code', [OrderController::class, 'getCodeOrder']);

    //=============================== Message Order Route ============================

    Route::get('/order/chat/user/message' , [ChatController::class , 'getUserMessage']);
    
    Route::post('/order/chat/send/message', [ChatController::class, 'sendMessage']);
    
});
