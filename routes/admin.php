<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AuthController;
use App\Http\Controllers\Admins\HomeController;
use App\Http\Controllers\Admins\RoleController;
use App\Http\Controllers\Admins\OrderController;
use App\Http\Controllers\Admins\CarDetailController;
use App\Http\Controllers\Admins\TrafficCarController;



Route::group(['prefix' => 'admin'], function () {



    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('admin.login');
        Route::post('submit_login', 'submit_login')->name('submit_login');
        Route::get('logout', 'logout')->name('admin.logout');
    });

    Route::middleware(['CheckAdminLogin'])->group(function () {

        Route::get('/home', [HomeController::class, 'home'])->name('admin.home');

        Route::controller(TrafficCarController::class)->group(function () {
            Route::get('car', 'index')->name('car.index');
            Route::post('add', 'addcar')->name('car.add');
            Route::get('show/{id}', 'showcar')->name('car.show');
            Route::post('edit/{id}', 'editcar')->name('car.edit');
            Route::delete('delete/{id}', 'destroy')->name('car.delete');
        });
        Route::controller(CarDetailController::class)->group(function () {
            Route::get('managecar', 'index')->name('cardetail.index');
            Route::post('caradd', 'store')->name('cardetail.add');
            Route::get('showcar/{id}', 'show')->name('cardetail.show');
            Route::post('editcar/{id}', 'update')->name('cardetail.edit');
            Route::get('deletecar/{id}', 'destroy')->name('cardetail.delete');
        });
        Route::controller(OrderController::class)->group(function () {
            Route::get('order', 'index')->name('order.index');
            Route::post('orderadd', 'store')->name('order.add');
            Route::get('showorder/{id}', 'show')->name('order.show');
            Route::post('editorder/{id}', 'update')->name('order.edit');
            Route::post('cancel/{id}','cancel')->name('order.cancel');
            Route::post('confirm/{id}','confirm')->name('order.confirm');
         });
         Route::controller(RoleController::class)->group(function () {
            Route::get('/roles','index')->name('role.index');
            // Route::get('/roles','index')->name('role.index')->middleware('permission:users.index');
            Route::post('/role/store','store')->name('role.store');
            Route::get('/role/edit/{id}','edit')->name('role.edit');
            Route::post('role/update/{id}','update')->name('role.update');
        });


    });
});
