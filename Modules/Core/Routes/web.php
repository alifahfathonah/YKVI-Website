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

// if (request()->has('lc') && request()->input('lc')) {
// 	$locale = request()->input('lc');
//     if (! in_array($locale, ['en', 'id'])) {
//         abort(400);
//     } else {
    	
//     }
// } else {
// 	App::setLocale('id');
// }

Route::middleware('auth')->group(function() {
	require __DIR__.'/api.php';
});

Route::get('set_locale/{locale}', 'DashboardController@setLocale')->name('set_locale');

Route::middleware('setlocale')->group(function() {
	Route::get('/backend', 'DashboardController@index')->name('dashboard.index');
});
