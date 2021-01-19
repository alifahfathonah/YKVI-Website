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

		Route::get('cme/table', 'CmeController@table')->name('cme.table');
		Route::get('cme/{cme}/data', 'CmeController@data')->name('cme.data');
		Route::apiResource('cme', 'CmeController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('e-learning/table', 'ELearningController@table')->name('e-learning.table');
		Route::get('e-learning/{e_learning}/data', 'ELearningController@data')->name('e-learning.data');
		Route::apiResource('e-learning', 'ELearningController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('product/table', 'ProductController@table')->name('product.table');
		Route::get('product/{product}/data', 'ProductController@data')->name('product.data');
		Route::apiResource('product', 'ProductController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('product-details/table', 'ProductDetailController@table')->name('product-details.table');
		Route::get('product-details/{product_detail}/data', 'ProductDetailController@data')->name('product-details.data');
		Route::apiResource('product-details', 'ProductDetailController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('product-category/table', 'ProductCategoryController@table')->name('product-category.table');
		Route::get('product-category/{product_category}/data', 'ProductCategoryController@data')->name('product-category.data');
		Route::apiResource('product-category', 'ProductCategoryController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('sym-card/table', 'SymCardController@table')->name('sym-card.table');
		Route::get('sym-card/{sym_card}/data', 'SymCardController@data')->name('sym-card.data');
		Route::apiResource('sym-card', 'SymCardController')->only([
			'store', 'update', 'destroy'
		]);

		Route::get('about-us/table', 'AboutUsController@table')->name('about-us.table');
		Route::get('about-us/{about_us}/data', 'AboutUsController@data')->name('about-us.data');
		Route::put('about-us/{about_us}/delete-image', 'AboutUsController@deleteImage')->name('about-us.delete-image');
		Route::apiResource('about-us', 'AboutUsController')->only([
			'store', 'update', 'destroy'
		]);
	});
});
