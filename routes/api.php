<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

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

Route::controller(CsrfCookieController::class)->group(function() {
    Route::get('/csrf', 'show')->name('csrf')->middleware('web');
});

Route::controller(AuthController::class)->prefix('/auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth');
    Route::post('/register', 'register')->middleware('auth')->middleware('permission:user.create|role.assign-to-user.*');
});

Route::controller(UserController::class)->prefix('/users')->group(function () {
    Route::get('/{id}', 'getById')->middleware('auth')->middleware('permission:user.read');
    Route::get('/{id}/roles', 'getRolesByUserId')->middleware('auth')->middleware('permission:user.read');
});

Route::prefix('/orders')->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::get('/', 'getAllInPage')->middleware('auth')->middleware('permission:order.read');
        Route::get('/{id}', 'getById')->middleware('auth')->middleware('permission:order.read');
    });


    Route::controller(OrderRequestController::class)->prefix('/requests')->group(function () {

    });
    Route::controller(OrderRequestController::class)->prefix('/{orderId}/requests')->group(function () {
        Route::post('/', 'orderRequest')->middleware('auth')->middleware('permission:order.request');
    });
});

