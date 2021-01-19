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
Route::namespace('Frontend')->group(function() {
	Route::get('banner', 'BannerController@index')->name('banner.index');
	Route::get('cme', 'CmeController@index')->name('cme.index');
	Route::get('e-learning', 'ELearningController@index')->name('e-learning.index');
	Route::get('about-us', 'AboutUsController@index')->name('about-us.index');
	Route::get('e-learning/faq', 'FaqController@index')->name('faq.index');
	Route::get('product', 'ProductController@index')->name('product.index');
	Route::get('product-category', 'ProductCategoryController@index')->name('product-category.index');
	Route::get('product/{product}', 'ProductController@detail')->name('product.detail');
	Route::get('sym-card', 'SymCardController@index')->name('sym-card.index');
	Route::post('contact-us/store', 'ContactUsController@store')->name('contact-us.store');
	Route::post('search', 'SearchController@index')->name('search');

	// English Version
	Route::prefix('en')->group(function() {
		Route::get('banner', 'BannerController@indexEng')->name('banner.index-en');
		Route::get('cme', 'CmeController@indexEng')->name('cme.index-en');
		Route::get('e-learning', 'ELearningController@indexEng')->name('e-learning.index-en');
		Route::get('about-us', 'AboutUsController@indexEng')->name('about-us.index-en');
		Route::get('e-learning/faq', 'FaqController@indexEng')->name('faq.index-en');
		Route::get('product', 'ProductController@indexEng')->name('product.index-en');
		Route::get('product-category', 'ProductCategoryController@indexEng')->name('product-category.index-en');
		Route::get('product/{product}', 'ProductController@detailEng')->name('product.detail-en');
		Route::get('sym-card', 'SymCardController@indexEng')->name('sym-card.index-en');
		Route::post('search', 'SearchController@indexEng')->name('search-en');
	});
});
