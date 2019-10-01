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

Route::get('/', 'IndexController@index')->name('home.index');
Route::get('/about', 'AboutController@index')->name('about.index');
Route::get('/lottery', 'LotteryController@index')->name('lottery.index');
Route::get('/shop', 'ShopController@index')->name('shop.index');

Route::prefix('news')->group(function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/{id}', 'NewsController@show')->name('news.show');
});

Route::prefix('contact')->group(function () {
    Route::get('/', 'ContactController@index')->name('contact.index');
    Route::post('submit', 'ContactController@send')->name('contact.send');
});

Route::prefix('memorial-garden')->group(function () {
    Route::get('/', 'MemorialGardenController@index')->name('memorial-garden.index');
    Route::get('/add-rememberance', 'MemorialGardenController@add')->name('memorial-garden.add');
    Route::post('send-request', 'MemorialGardenController@send')->name('memorial-garden.send');
});

Route::post('postcode-lookup', 'ActionsController@getAddresses');

Route::prefix('admin')->namespace('Admin')->group(function () {
	Route::name('admin.')->group(function () {
	    Route::resource('lottery', 'LotteryController');
	    Route::resource('news', 'NewsController');
	});
    
});