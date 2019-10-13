<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer;

use Illuminate\Support\Facades\Route;

$prefix = config('admin-mailer.prefix') . '.';


Route::name($prefix)->group(function ()
{
    Route::get('/', 'HomeController@index')->name('index'); //the overview page (admin-mailer.index)
    Route::prefix('customers')->name('customers.')->group(function ()
    {
        Route::get('', 'CustomerController@index')->name('index'); //name = admin-mailer.customers.index
        Route::get('show/{id}', 'CustomerController@show')->name('show');
        Route::get('create', 'CustomerController@create')->name('create');
        Route::post('store', 'CustomerController@store')->name('store');
        Route::get('{id}/edit', 'CustomerController@edit')->name('edit');
        Route::put('{id}/update', 'CustomerController@update')->name('update');
        Route::delete('{id}/destroy', 'CustomerController@destroy')->name('destroy');
        //datatable
        Route::get('table/index', 'CustomerController@tableIndex')->name('table.index');
    });

    Route::prefix('lists')->name('lists.')->group(function ()
    {
        Route::get('/', 'ListController@index')->name('index'); //name = admin-mailer.lists.index
        Route::get('show/{id}', 'ListController@show')->name('show');
        Route::get('create', 'ListController@create')->name('create');
        Route::post('store', 'ListController@store')->name('store');
        Route::get('{id}/edit', 'ListController@edit')->name('edit');
        Route::put('{id}/update', 'ListController@update')->name('update');
        Route::delete('{id}/destroy', 'ListController@destroy')->name('destroy');
        Route::get('{id}/customers', 'ListController@customers')->name('customers');
        Route::get('{id}/campaigns', 'ListController@campaigns')->name('campaigns');
    });

    Route::prefix('campaigns')->name('campaigns.')->group(function ()
    {
        Route::get('/', 'CampaignController@index')->name('index'); //name = admin-mailer.campaigns.index
        Route::get('show/{id}', 'CampaignController@show')->name('show');
        Route::get('create', 'CampaignController@create')->name('create');
        Route::post('store', 'CampaignController@store')->name('store');
        Route::get('{id}/edit', 'CampaignController@edit')->name('edit');
        Route::put('{id}/update', 'CampaignController@update')->name('update');
        Route::delete('{id}/destroy', 'CampaignController@destroy')->name('destroy');
        Route::get('lists', 'CampaignController@listsView')->name('lists');
        Route::get('{id}/customers', 'CampaignController@customers')->name('customers');
        Route::get('{id}/emails', 'CampaignController@emails')->name('emails');
    });

    Route::prefix('emails')->name('emails.')->group(function ()
    {
        Route::get('/', 'EmailController@index')->name('index'); //name = admin-mailer.emails.index
        Route::get('show/{id}', 'EmailController@show')->name('show');
        Route::get('create/{campaign_id?}', 'EmailController@create')->name('create');
        Route::post('store', 'EmailController@store')->name('store');
        Route::get('{id}/edit', 'EmailController@edit')->name('edit');
        Route::put('{id}/update', 'EmailController@update')->name('update');
        Route::delete('{id}/destroy', 'EmailController@destroy')->name('destroy');
        Route::get('lists', 'EmailController@listsView')->name('lists');
        Route::get('{id}/copy', 'EmailController@copyEmail')->name('copy');
        Route::get('send_test/{id}', 'EmailController@sendTest')->name('send_copy'); //ajax function
    });

    Route::prefix('mailer')->name('mailer.')->group(function ()
    {
        Route::get('/', 'MailerController@index')->name('index'); //name = admin-mailer.mailer.index
        Route::get('{id}/send', 'MailerController@send')->name('send');
        Route::post('sending_email', 'MailerController@sending')->name('sending');
    });

    Route::prefix('logs')->name('logs.')->group(function ()
    {
        Route::get('/', 'LogController@index')->name('index'); //name = admin-mailer.logs.index
        Route::get('{email_id}/read', 'LogController@read')->name('read');
        Route::get('{email_id}/unsubscribed', 'LogController@unsubscribed')->name('unsubscribed');
    });
});
