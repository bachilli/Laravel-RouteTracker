<?php

/*
|--------------------------------------------------------------------------
| Rotas Web
|--------------------------------------------------------------------------
|
| Neste arquivo é onde você define todas as rotas que são utilizadas pela
| sua aplicação. Mais informações: https://laravel.com/docs/5.3/routing
|
*/

//
// Primary
//

Route::get('/', 'Primary\HomepageController@index');

// Pesquisar
Route::get('pesquisar', 'Primary\SearchController@index');

// Jogos
Route::get('jogos', 'Primary\GameController@index');
Route::get('jogos/{slug}', 'Primary\GameController@single');

// Tags
Route::get('tags', 'Primary\TagController@index');
Route::get('tag/{slug}', 'Primary\TagController@single');

//
// Painel de Controle (CPanel)
//

Route::group([ 'prefix' => 'cpanel' ], function()
{
    // Dashboard
    Route::get('/', 'CPanel\DashboardController@index');

    // Tags
    Route::get('tags/overview', 'CPanel\TagController@overview');
    Route::resource('tags', 'CPanel\TagController');

    // Games
    Route::get('games/publish/{game}', 'CPanel\GameController@publish');
    Route::get('games/overview', 'CPanel\GameController@overview');
    Route::resource('games', 'CPanel\GameController');

    // Distributors
    Route::get('distributors/overview', 'CPanel\DistributorController@overview');
    Route::resource('distributors', 'CPanel\DistributorController');

    // Publications
    Route::get('publications/overview', 'CPanel\PublicationController@overview');
    Route::resource('publications', 'CPanel\PublicationController');

    // Famobi
    Route::get('source/famobi', 'CPanel\Distributors\FamobiController@index');

    // ClickJogos
    Route::get('source/clickjogos/categories', 'CPanel\Distributor\ClickJogosController@categories');
    Route::get('source/clickjogos/games', 'CPanel\Distributor\ClickJogosController@games');
});