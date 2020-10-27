<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('backend')->group(function() {
	Route::prefix('contact-us')->namespace('Api')->group(function() {
	    Route::get('table', 'ContactUsController@table')->name('contact-us.table');
		Route::get('{contact_us}/data', 'ContactUsController@data')->name('contact-us.data');
		Route::apiResource('', 'ContactUsController')->only([
			'update'
		]);
	});
});
