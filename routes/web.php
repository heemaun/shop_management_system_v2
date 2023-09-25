<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellOrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthUserMiddleware;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

//resource routes

Route::middleware([LoginMiddleware::class,AuthUserMiddleware::class])->group(function(){
    Route::resource('/accounts',AccountController::class);
    Route::resource('/categories',CategoryController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('/purchases',PurchaseController::class);
    Route::resource('/purchase-orders',PurchaseOrderController::class);
    Route::resource('/sells',SellController::class);
    Route::resource('/sell-orders',SellOrderController::class);
    Route::resource('/settings',SettingController::class);
    Route::resource('/statuses',StatusController::class);
    Route::resource('/users',UserController::class);
    Route::resource('/cart',CartController::class);
    Route::resource('/transactions',TransactionController::class);
    Route::resource('/roles',RoleController::class);
    Route::resource('/permissions',PermissionController::class);

    // Route::withoutMiddleware([LoginMiddleware::class,AuthUserMiddleware::class])->group(function(){
    //     Route::resource('/users',UserController::class)->only(['create','store']);
    // });
});


// Route::resource('/accounts',AccountController::class);
// Route::resource('/categories',CategoryController::class);
// Route::resource('/products',ProductController::class);
// Route::resource('/purchases',PurchaseController::class);
// Route::resource('/purchase-orders',PurchaseOrderController::class);
// Route::resource('/sells',SellController::class);
// Route::resource('/sell-orders',SellOrderController::class);
// Route::resource('/settings',SettingController::class);
// Route::resource('/statuses',StatusController::class);
// Route::resource('/users',UserController::class);
// Route::resource('/cart',CartController::class);
// Route::resource('/transactions',TransactionController::class);
// Route::resource('/roles',RoleController::class);
// Route::resource('/permissions',PermissionController::class);

//login routes
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

// home routes
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/register',[HomeController::class,'register'])->name('register');
Route::get('/home-product-view',[HomeController::class,'productView'])->name('home-product-view');
Route::get('/home-category-search',[HomeController::class,'searchCategory'])->name('home-category-search');
Route::get('/home-product-search',[HomeController::class,'searchProduct'])->name('home-product-search');