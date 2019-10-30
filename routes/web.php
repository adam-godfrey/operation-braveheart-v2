<?php

use Illuminate\Http\Request;
use App\Models\PlaqueOrder;
use App\Mail\PlaqueReceipt;
use Illuminate\Support\Facades\Mail;

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

Auth::routes(['register' => false]);

Route::get('/test', 'ActionsController@test')->name('test');

// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/', 'IndexController@index')->name('home.index');
Route::get('about', 'AboutController@index')->name('about.index');

Route::get('shop', 'ShopController@index')->name('shop.index');

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
    Route::get('add-rememberance', 'MemorialGardenController@add')->name('memorial-garden.add');
    Route::post('send-request', 'MemorialGardenController@send')->name('memorial-garden.send');
});

Route::prefix('lottery')->group(function () {
    Route::get('/', 'LotteryController@index')->name('lottery.index');
    Route::get('join', 'LotteryController@join')->name('lottery.join');
    Route::post('send-request', 'LotteryController@send')->name('lottery.send');
});

Route::prefix('api')->group(function () {
    Route::post('/upload', 'ActionsController@uploadFile');
    Route::get('/file', 'ActionsController@readFile');
    Route::get('/stream-video', 'ActionsController@streamVideo')->name('stream-video');
});

Route::post('postcode-lookup', 'ActionsController@getAddresses');

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {

    Route::group(['prefix' => 'memorial-garden'], function() {
        Route::get('/', 'MemorialGardenController@index');
        Route::get('/plaque-orders', 'MemorialGardenController@orders');
        Route::get('/plaque-orders/{id}/edit', 'MemorialGardenController@edit');
        Route::put('/plaque-orders/update', 'MemorialGardenController@update');
        Route::post('/plaque-orders/send', 'MemorialGardenController@send');
    });

    Route::group(['prefix' => 'lottery'], function() {

        Route::get('/', 'LotteryController@index');
        Route::get('settings', 'LotteryController@settings');
        Route::get('draw/{draw}', 'LotteryController@draw');
        Route::post('get-winner', 'LotteryController@getWinner');
        Route::post('draw/save', 'LotteryController@store');
        Route::put('additional-numbers', 'LotteryController@additionalNumbers');
        Route::put('update-total-winners', 'LotteryController@totalWinners');
        Route::put('update-draw-date', 'LotteryController@updateDrawDate');
        Route::put('update-prizes', 'LotteryController@updatePrizes');

        Route::get('players/get', 'LotteryPlayerController@getPlayers');
        Route::post('available-numbers', 'LotteryPlayerController@getAvailableNumbers');
        Route::get('players/paid', 'LotteryPlayerController@getPaidPlayers');
        Route::put('players/update-paid', 'LotteryPlayerController@updatePaidStatus');
        
        
        Route::resource('players', 'LotteryPlayerController');
    });

    Route::group(['prefix' => 'emails'], function() {
        Route::get('get', 'EmailsController@getEmails');
    });

    Route::name('admin.')->group(function () {
        Route::resource('emails', 'EmailsController');
    });

    Route::name('admin.')->group(function () {
        Route::resource('news', 'NewsController');
    });
});

Route::post('checkout', 'ActionsController@checkout');

Route::get('download-receipt/{id}', 'ActionsController@createPDFReceipt');
