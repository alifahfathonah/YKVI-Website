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
	Route::prefix('master-data')->namespace('View')->group(function() {
	    Route::resource('faq', 'FaqController')->only([
			'index', 'create', 'edit'
		]);

		Route::resource('banner', 'BannerController')->only([
			'index', 'create', 'edit'
		]);

		Route::resource('cme', 'CmeController')->only([
			'index', 'create', 'edit'
		]);

		Route::resource('e-learning', 'ELearningController')->only([
			'index', 'create', 'edit'
		]);

		Route::resource('product', 'ProductController')->only([
			'index', 'create', 'edit'
		]);

		Route::resource('product-details', 'ProductDetailController')->only([
			'index', 'create', 'edit'
		]);
	});
});
