<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'pages.home')->name('home');
Route::view('/products', 'pages.products')->name('products');
Route::view('/categories', 'pages.categories')->name('categories');
Route::view('/cart', 'pages.cart')->name('cart');
Route::view('/contact', 'pages.contact')->name('contact');
=======
Route::view('/', 'welcome');
