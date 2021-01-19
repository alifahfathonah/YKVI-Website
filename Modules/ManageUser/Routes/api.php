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

Route::middleware('setlocale')->prefix('backend')->group(function() {
	Route::prefix('kelola-user')->namespace('Api')->group(function() {
	    Route::get('user/table', 'UserController@table')->name('user.table');
		Route::get('user/{user}/data', 'UserController@data')->name('user.data');
		Route::apiResource('user', 'UserController')->only([
		    'store', 'update', 'destroy'
		]);
	});

	Route::prefix('change-password')->namespace('Api')->group(function() {
		Route::put('update/{user}', 'UserController@changePassword')->name('change-password.update');
	});
});