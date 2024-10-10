<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\bannerController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\commanController;
use App\Http\Controllers\userController;
use App\Http\Controllers\contentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\orgStructuteController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    // Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(userController::class)->group(function () {
    Route::get('user', 'viewUser');
    Route::post('add-edit-user', 'addUser');
    Route::delete('delete-user', 'deleteUser');
});


Route::controller(profileController::class)->group(function () {
    Route::get('get-profile', 'getProfile');
});

Route::controller(bannerController::class)->group(function () {
    Route::get('get-banner', 'getBanner');
});

Route::controller(menuController::class)->group(function () {
    Route::get('menu', 'getMenu');
    Route::post('add-edit-menu', 'addMenu');
    Route::delete('delete-menu', 'deleteMenu');
    Route::get('parentMaster', 'parentMaster');
    Route::get('menu-tree', 'buildMenuTree');
});

Route::controller(contentController::class)->group(function () {
    Route::get('content', 'getContent');
    Route::post('add-edit-content', 'addContent');
    Route::delete('delete-content', 'deleteContent');
});

Route::controller(orgStructuteController::class)->group(function () {
    Route::get('org', 'getOrg');
    Route::post('add-edit-org', 'addOrg');
    Route::delete('delete-org', 'deleteOrg');
});

Route::controller(commanController::class)->group(function () {
    Route::get('status-change/{status}/{id}/{db}', 'StatusChange');
});

Route::post('send-mail', [MailController::class, 'index']);
