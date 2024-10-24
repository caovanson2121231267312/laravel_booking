<?php

use App\Http\Controllers\Admins\AuthController;
use App\Http\Controllers\Admins\HomeController;
use App\Http\Controllers\Admins\TrafficCarController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin'], function () {


     Route::get('/home',[HomeController::class,'home'])->name('admin.home');

     Route::controller(AuthController::class)->group(function(){
        Route::get('login','login')->name('admin.login');
        Route::post('submit_login','submit_login')->name('submit_login');
        Route::get('logout','logout')->name('admin.logout');


     });
     Route::controller(TrafficCarController::class)->group(function(){
        Route::get('car','index')->name('car.index');
        Route::post('add','addcar')->name('car.add');
        Route::get('show/{id}','showcar')->name('car.show');
        Route::post('edit/{id}','editcar')->name('car.edit');
        Route::delete('delete/{id}','destroy')->name('car.delete');

     });




});



