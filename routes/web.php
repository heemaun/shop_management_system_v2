<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\SellOrderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//resource routes
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

//login routes
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

// home routes
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/add-to-cart',[HomeController::class,'addToCart'])->name('add-to-cart');
Route::get('/home-product-view',[HomeController::class,'productView'])->name('home-product-view');