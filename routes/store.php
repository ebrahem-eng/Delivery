<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Store\Auth\AuthController;
use App\Http\Controllers\Store\Catigory\CatigoryController;
use App\Http\Controllers\Store\Order\OrderController;
use App\Http\Controllers\Store\Product\ProductController;
use App\Http\Controllers\Store\Profile\ProfileController as ProfileProfileController;
use App\Http\Controllers\Store\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| store Routes
|--------------------------------------------------------------------------
|
| Here is where you can register store routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "store" middleware group. Make something great!
|
*/

//=================== Auth Route ==============
Route::get('store/login', [AuthController::class, 'login_page'])->name('store.login.page');
Route::post('store/login/check', [AuthController::class, 'login_check'])->name('store.login.check');


Route::middleware(['Store'])->name('store.')->prefix('store')->group(function () {

    Route::get('/dashboard', [StoreController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //product routes

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get("/product/edit/{id}", [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get("/product/archive", [ProductController::class, 'archive'])->name('product.archive');
    Route::delete('/product/softDeletes/{id}', [ProductController::class, 'soft_delete'])->name('product.soft.deletes');
    Route::delete('/product/Force/Delete/{id}', [ProductController::class, 'force_delete'])->name('product.force.delete');
    Route::get('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');

    //Order routes

    Route::get('/order/new/order', [OrderController::class, 'new_order'])->name('order.new.order');
    Route::post('/order/accept/new/order/{id}', [OrderController::class, 'accept_new_order'])->name('order.new.order.accept');
    Route::post('/order/refusal/new/order/{id}', [OrderController::class, 'refusal_new_order'])->name('order.new.order.refusal');
    Route::get('/order/active/order', [OrderController::class, 'active_order'])->name('order.active.order');
    Route::post('/order/active/start/preparation/order/{id}', [OrderController::class, 'start_preparation_active_order'])->name('order.active.order.start.preparation');
    Route::post('/order/active/finish/preparation/order/{id}', [OrderController::class, 'finish_preparation_active_order'])->name('order.active.order.finish.preparation');
    Route::post('/order/active/approval/delivery/order/{id}', [OrderController::class, 'approval_delivery_active_order'])->name('order.active.order.approval.delivery');
    Route::get('/order/finish/order', [OrderController::class, 'finish_order'])->name('order.finish.order');
    Route::get('/order/refusal/order', [OrderController::class, 'refusal_order'])->name('order.refusal.order');


    //================ Catigory Route =================
    Route::get('/catigory', [CatigoryController::class, 'index'])->name('catigory.index');
    Route::get('/catigory/create', [CatigoryController::class, 'create'])->name('catigory.create');
    Route::post('/catigory/store', [CatigoryController::class, 'store'])->name('catigory.store');
    Route::get('/catigory/edit/{id}', [CatigoryController::class, 'edit'])->name('catigory.edit');
    Route::put('/catigory/update/{id}', [CatigoryController::class, 'update'])->name('catigory.update');
    Route::get("/catigory/archive", [CatigoryController::class, 'archive'])->name('catigory.archive');
    Route::delete('/catigory/softDeletes/{id}', [CatigoryController::class, 'soft_delete'])->name('catigory.soft.deletes');
    Route::delete('/catigory/Force/Delete/{id}', [CatigoryController::class, 'force_delete'])->name('catigory.force.delete');
    Route::get('/catigory/restore/{id}', [CatigoryController::class, 'restore'])->name('catigory.restore');


    // //route to delete later
    // Route::post('/order/new/order/accept/delivery/{id}', [OrderController::class, 'new_order_accept_delivery'])->name('order.new.order.aaccept.delivery');

    //profile routes

    Route::get('/profile', [ProfileProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/personal/info/{id}', [ProfileProfileController::class, 'update_personal_info'])->name('profile.update.personal.info');
    Route::put('/profile/reset/password/{id}', [ProfileProfileController::class, 'reset_password'])->name('profile.reset.password');
    Route::put('/profile/update/contact/info/{id}', [ProfileProfileController::class, 'update_contact_info'])->name('profile.update.contact.info');
    Route::put('/profile/update/address/info/{id}', [ProfileProfileController::class, 'update_address_info'])->name('profile.update.address.info');
});
