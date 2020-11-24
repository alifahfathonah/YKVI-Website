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
	Route::get('product/{product}', 'ProductController@detail')->name('product.detail');
	Route::get('sym-card', 'SymCardController@index')->name('sym-card.index');
	Route::post('contact-us/store', 'ContactUsController@store')->name('contact-us.store');
});
