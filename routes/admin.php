<?php

use App\Http\Controllers\Admin\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Catigory\CatigoryController;
use App\Http\Controllers\Admin\DeliveryAgent\DeliveryAgentController;
use App\Http\Controllers\Admin\DiscountCode\DiscountCodeController;
use App\Http\Controllers\Admin\Profile\ProfileController as ProfileProfileController;
use App\Http\Controllers\Admin\Store\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

//=================== Auth Route ==============
Route::get('admin/login', [AuthController::class, 'login_page'])->name('admin.login.page');
Route::post('admin/login/check', [AuthController::class, 'login_check'])->name('admin.login.check');



Route::middleware(['Admin'])->name('admin.')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    //store routes

    Route::middleware(['AdminType'])->group(function () {


        Route::get('/store', [StoreController::class, 'index'])->name('store.index');
        Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
        Route::post('/store/store', [StoreController::class, 'store'])->name('store.store');
        Route::get("/store/edit/{id}", [StoreController::class, 'edit'])->name('store.edit');
        Route::put('/store/update/{id}', [StoreController::class, 'update'])->name('store.update');
        Route::get("/store/archive", [StoreController::class, 'archive'])->name('store.archive');
        Route::get("/store/edit/location/{id}", [StoreController::class, 'editLocation'])->name('store.edit.location');
        Route::put("/store/update/location/{id}", [StoreController::class, 'updateLocation'])->name('store.update.location');
        Route::delete('/store/softDeletes/{id}', [StoreController::class, 'soft_delete'])->name('store.soft.deletes');
        Route::delete('/store/Force/Delete/{id}', [StoreController::class, 'force_delete'])->name('store.force.delete');
        Route::get('/store/restore/{id}', [StoreController::class, 'restore'])->name('store.restore');

        //admin route 

        Route::get('/admin', [AdminAdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create', [AdminAdminController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [AdminAdminController::class, 'store'])->name('admin.store');
        Route::get("/admin/edit/{id}", [AdminAdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/update/{id}', [AdminAdminController::class, 'update'])->name('admin.update');
        Route::get("/admin/archive", [AdminAdminController::class, 'archive'])->name('admin.archive');
        Route::delete('/admin/softDeletes/{id}', [AdminAdminController::class, 'soft_delete'])->name('admin.soft.deletes');
        Route::delete('/admin/Force/Delete/{id}', [AdminAdminController::class, 'force_delete'])->name('admin.force.delete');
        Route::get('/admin/restore/{id}', [AdminAdminController::class, 'restore'])->name('admin.restore');


        //discount code route

        Route::get('/discount/code', [DiscountCodeController::class, 'index'])->name('discount.code.index');
        Route::get('/discount/code/create', [DiscountCodeController::class, 'create'])->name('discount.code.create');
        Route::post('/discount/code/store', [DiscountCodeController::class, 'store'])->name('discount.code.store');
        Route::get("/discount/code/edit/{id}", [DiscountCodeController::class, 'edit'])->name('discount.code.edit');
        Route::put('/discount/code/update/{id}', [DiscountCodeController::class, 'update'])->name('discount.code.update');
        Route::get("/discount/code/archive", [DiscountCodeController::class, 'archive'])->name('discount.code.archive');
        Route::delete('/discount/code/softDeletes/{id}', [DiscountCodeController::class, 'soft_delete'])->name('discount.code.soft.deletes');
        Route::delete('/discount/code/Force/Delete/{id}', [DiscountCodeController::class, 'force_delete'])->name('discount.code.force.delete');
        Route::get('/discount/code/restore/{id}', [DiscountCodeController::class, 'restore'])->name('discount.code.restore');

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
    });
    //delivery agent route

    Route::get('/delivery/agent', [DeliveryAgentController::class, 'index'])->name('delivery.agent.index');
    Route::get('/delivery/agent/create', [DeliveryAgentController::class, 'create'])->name('delivery.agent.create');
    Route::post('/delivery/agent/store', [DeliveryAgentController::class, 'store'])->name('delivery.agent.store');
    Route::get("/delivery/agent/edit/{id}", [DeliveryAgentController::class, 'edit'])->name('delivery.agent.edit');
    Route::put('/delivery/agent/update/{id}', [DeliveryAgentController::class, 'update'])->name('delivery.agent.update');
    Route::get("/delivery/agent/archive", [DeliveryAgentController::class, 'archive'])->name('delivery.agent.archive');
    Route::delete('/delivery/agent/softDeletes/{id}', [DeliveryAgentController::class, 'soft_delete'])->name('delivery.agent.soft.deletes');
    Route::delete('/delivery/agent/Force/Delete/{id}', [DeliveryAgentController::class, 'force_delete'])->name('delivery.agent.force.delete');
    Route::get('/delivery/agent/restore/{id}', [DeliveryAgentController::class, 'restore'])->name('delivery.agent.restore');

    //profile routes

    Route::get('/profile', [ProfileProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/personal/info/{id}', [ProfileProfileController::class, 'update_personal_info'])->name('profile.update.personal.info');
    Route::put('/profile/reset/password/{id}', [ProfileProfileController::class, 'reset_password'])->name('profile.reset.password');
    Route::put('/profile/update/contact/info/{id}', [ProfileProfileController::class, 'update_contact_info'])->name('profile.update.contact.info');
});
