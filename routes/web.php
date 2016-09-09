<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'Primary\HomepageController@index');

//
// CPanel
//

Route::group([ 'prefix' => 'cpanel' ], function()
{
    Route::get('/', 'CPanel\DashboardController@index');

    // Categories
    Route::get('categories/overview', 'CPanel\CategoryController@overview');
    Route::resource('categories', 'CPanel\CategoryController');

    // Tags
    Route::get('tags/overview', 'CPanel\TagController@overview');
    Route::resource('tags', 'CPanel\TagController');

    // Games
    Route::get('games/overview', 'CPanel\GameController@overview');
    Route::resource('games', 'CPanel\GameController');
});

//
// Crawler
//

Route::group([ 'prefix' => 'crawler' ], function()
{
    Route::group([ 'prefix' => 'clickjogos' ], function()
    {
        Route::get('categories', 'CPanel\Crawler\ClickJogos\CategoryController@index');
        Route::get('games', 'CPanel\Crawler\ClickJogos\GameController@index');
    });
});