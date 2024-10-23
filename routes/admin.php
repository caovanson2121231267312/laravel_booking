<?php

use App\Http\Controllers\Admins\AuthController;
use App\Http\Controllers\Admins\HomeController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {


     Route::get('/home',[HomeController::class,'home'])->name('admin.home');

     Route::controller(AuthController::class)->group(function(){
        Route::get('login','login')->name('admin.login');
        Route::post('submit_login','submit_login')->name('submit_login');
        Route::get('logout','logout')->name('admin.logout');

     });




});



