<?php

namespace Dimimo\AdminMailer;

use Illuminate\Support\Facades\Route;

//part of AdminMailer
Route::get('unsubscribe', 'SubscribeController@unsubscribe')->name('admin-mailer.unsubscribe');
Route::get('subscribe', 'SubscribeController@subscribe')->name('admin-mailer.subscribe');
//this route is used for tracking the email picture if shown on the customers mail client
Route::get(config('admin-mailer.logo_link'), 'LogController@logo');