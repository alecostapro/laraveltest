<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('customers', 'CustomerController')->except('show')->middleware('can:manage-all');
Route::resource('orders', 'OrderController')->except('show')->middleware('can:manage-all');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
