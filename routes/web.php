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
Route::get('/memorial-garden', 'MemorialGardenController@index')->name('memorial-garden.index');
Route::get('/shop', 'ShopController@index')->name('shop.index');

Route::prefix('news')->group(function () {
    Route::get('/', 'NewsController@index')->name('news.index');
});

Route::prefix('contact')->group(function () {
    Route::get('/', 'ContactController@index')->name('contact.index');
    Route::post('submit', 'ContactController@send')->name('contact.send');
});
