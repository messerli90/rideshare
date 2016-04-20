<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'RidesController@index');
Route::get('about', 'PagesController@about');

Route::auth();

Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
    Route::get('/', ['uses' => 'UsersController@dashboard', 'name' => 'dashboard']);
    Route::put('/', 'UsersController@update');
    Route::get('edit', 'UsersController@edit');
    Route::get('favorites', 'FavoritesController@index');
});

Route::group(['prefix' => 'users'], function() {
   Route::get('{user}', 'UsersController@profile');
});

Route::group(['prefix' => 'rides'], function () {
    Route::get('/', 'RidesController@index');
    Route::post('/', 'RidesController@store', ['middleware' => 'auth']);
    Route::get('create', ['uses' => 'RidesController@create', 'middleware' => 'auth']);
    Route::get('{ride}', 'RidesController@show');
    Route::put('{ride}', ['uses' => 'RidesController@update', 'middleware' => 'auth']);
    Route::get('{ride}/edit', ['uses' => 'RidesController@edit', 'middleware' => 'auth']);
    Route::get('{ride}/delete', ['uses' => 'RidesController@destroy', 'middleware' => 'auth']);
    Route::post('{ride}/comment', ['uses' => 'RidesController@comment', 'middleware' => 'auth']);
    Route::get('{ride}/add-passenger', ['uses' => 'RidesController@addPassenger', 'middleware' => 'auth']);
    Route::get('{ride}/add-favorite', ['uses' => 'FavoritesController@addRide', 'middleware' => 'auth']);
});