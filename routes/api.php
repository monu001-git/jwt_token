<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\commanController;
use App\Http\Controllers\userController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(userController::class)->group(function(){
    Route::get('user/{id?} ','viewUser'); 
    Route::get('add-edit-user/{id?}','addUser');
    Route::get('delete-user/{id}', 'deleteUser');
});


Route::controller(profileController::class)->group(function(){
    Route::get('get-profile','getProfile');
});

Route::controller(bannerController::class)->group(function(){
    Route::get('get-banner','getBanner');
});

Route::controller(menuController::class)->group(function(){
    Route::get('get-menu','getMenu');
    Route::get('addMenu/{id?}','addMenu');
});

Route::controller(commanController::class)->group(function(){
    Route::get('status-change/{status}/{id}/{db}','StatusChange');  
});