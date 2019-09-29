<?php

namespace Dimimo\AdminMailer;

use Illuminate\Support\Facades\Route;

$prefix = config('admin-mailer.prefix') . '.';

Route::get('/', 'HomeController@index');
Route::prefix('customers')->group(function() use ($prefix) {
    Route::get('/', 'CustomerController@index')->name($prefix. 'customers.index');
    Route::get('/show/{id}', 'CustomerController@show')->name($prefix.'customers.show');
    Route::get('/create', 'CustomerController@create')->name($prefix.'customers.create');
    Route::post('/store', 'CustomerController@store')->name($prefix.'customers.store');
    Route::get('/{id}/edit', 'CustomerController@edit')->name($prefix.'customers.edit');
    Route::put('{id}/update', 'CustomerController@update')->name($prefix.'customers.update');
});