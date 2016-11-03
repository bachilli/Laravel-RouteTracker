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

Route::group([ 'prefix' => '' ], function()
{
    // Página Inicial
    Route::get('/', 'Primary\HomepageController@index');

    // Pesquisar
    Route::get('pesquisar', 'Primary\SearchController@index');

    // Jogos
    Route::get('jogos', 'Primary\GameController@index');
    Route::get('jogos/{slug}', 'Primary\GameController@single');

    // Tags
    Route::get('tags', 'Primary\TagController@index');
    Route::get('tags/{slug}', 'Primary\TagController@single');
});

//
// CPanel (Painel de Controle)
//

Route::group([ 'prefix' => 'cpanel' ], function()
{
    // Dashboard
    Route::get('/', 'CPanel\DashboardController@index');

    // Tags
    Route::get('tags/visibility/{tag}', 'CPanel\TagController@visibility');
    Route::get('tags/overview', 'CPanel\TagController@overview');
    Route::resource('tags', 'CPanel\TagController');

    // Games
    Route::get('games/visibility/{game}', 'CPanel\GameController@visibility');
    Route::get('games/overview', 'CPanel\GameController@overview');
    Route::resource('games', 'CPanel\GameController');

    // Publications
    Route::get('publications/overview', 'CPanel\PublicationController@overview');
    Route::resource('publications', 'CPanel\PublicationController');

    // Distributors
    Route::get('distributor/famobi', 'CPanel\Distributor\FamobiController@index');
    Route::get('distributor/famobi/publish', 'CPanel\DistributorController@famobi');
    Route::get('distributor/spilgames', 'CPanel\Distributor\SpilGamesController@index');
    Route::get('distributor/spilgames/publish', 'CPanel\DistributorController@spilgames');
    Route::get('distributors/overview', 'CPanel\DistributorController@overview');
    Route::resource('distributors', 'CPanel\DistributorController');
});

//
// Ajax
//

Route::group([ 'prefix' => 'ajax' ], function()
{
    Route::post('utility/slug', 'Ajax\SlugController@index');
    Route::post('utility/second-to-hour', 'Ajax\SecondToHourController@index');
});