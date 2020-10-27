<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('backend')->group(function() {
	Route::namespace('View')->group(function() {
		Route::get('contact-us/{contact_us}/detail', 'ContactUsController@edit')->name('contact-us.edit');
	    Route::resource('contact-us', 'ContactUsController')->only([
			'index'
		]);
	});
});
