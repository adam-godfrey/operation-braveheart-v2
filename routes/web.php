<?php

use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

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

Auth::routes();

// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index')->name('home.index');
Route::get('/about', 'AboutController@index')->name('about.index');

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

Route::prefix('lottery')->group(function () {
    Route::get('/', 'LotteryController@index')->name('lottery.index');
    Route::get('/play', 'LotteryController@payment')->name('lottery.payment');
});

Route::post('postcode-lookup', 'ActionsController@getAddresses');

Route::prefix('admin')->middleware('auth')->namespace('Admin')->group(function () {

    Route::group(['prefix' => 'lottery'], function() {

        Route::get('/', 'LotteryController@index');
        Route::get('/draw/{draw}', 'LotteryController@draw');
        Route::post('get-winner', 'LotteryController@getWinner');
        Route::put('additional-numbers', 'LotteryController@additionalNumbers');
        Route::put('update-total-winners', 'LotteryController@totalWinners');
        Route::put('update-draw-date', 'LotteryController@updateDrawDate');

        Route::get('players/get', 'LotteryPlayerController@getPlayers');
        Route::post('available-numbers', 'LotteryPlayerController@getAvailableNumbers');
        
        Route::resource('players', 'LotteryPlayerController');
    });

    Route::delete('users/{user}/delete', 'LotteryController@deleteUser');

    Route::get('news/articles', 'NewsController@getNewsArticles');
    Route::delete('users/{user}/delete', 'LotteryController@deleteUser');

    Route::name('admin.')->group(function () {
        Route::resource('news', 'NewsController');
    });
});

Route::post('/checkout', function(Request $request) {
    // dd($request->all());
    // validation
    try {

        Stripe::setApiKey(env('STRIPE_API_SECRET'));

        $charge = Stripe::charges()->create([
            'amount' => 16.00,
            'currency' => 'GBP',
            'source' => $request->stripeToken,
            'description' => 'Description goes here',
            'receipt_email' => $request->email,
            'metadata' => [
                'data1' => 'metadata 1',
                'data2' => 'metadata 2',
                'data3' => 'metadata 3',
            ],
        ]);
        // save this info to your database
        // SUCCESSFUL
        return back()->with('success_message', 'Thank you! Your payment has been accepted.');
    } catch (CardErrorException $e) {
        // save info to database for failed
        return back()->withErrors('Error! ' . $e->getMessage());
    }
});
