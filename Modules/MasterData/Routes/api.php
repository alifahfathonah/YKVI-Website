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
Route::prefix('master-data')->namespace('Api')->group(function() {
    Route::get('faq/table', 'FaqController@table')->name('faq.table');
	Route::get('faq/{faq}/data', 'FaqController@data')->name('faq.data');
	Route::apiResource('faq', 'FaqController')->only([
		'store', 'update', 'destroy'
	]);

	Route::get('banner/table', 'BannerController@table')->name('banner.table');
	Route::get('banner/{banner}/data', 'BannerController@data')->name('banner.data');
	Route::apiResource('banner', 'BannerController')->only([
		'store', 'update', 'destroy'
	]);

	Route::get('e-learning/table', 'ELearningController@table')->name('e-learning.table');
	Route::get('e-learning/{e_learning}/data', 'ELearningController@data')->name('e-learning.data');
	Route::apiResource('e-learning', 'ELearningController')->only([
		'store', 'update', 'destroy'
	]);
});