<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function(){
        Route::match(['get','post'], 'dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
        Route::get('logout', [AdminController::class, 'logout']);
    });
});