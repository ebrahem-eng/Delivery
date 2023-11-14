<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| shareAuth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register shareAuth routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "shareAuth" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'userD' ,'deliveryAgent', // Use multiple guards
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});