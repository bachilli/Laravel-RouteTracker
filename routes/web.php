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
Route::get('pesquisar/{query}', 'Primary\SearchController@show');

// Jogos
Route::get('jogos', 'Primary\GameController@index');
Route::get('jogo/{slug}', 'Primary\GameController@single');

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
    Route::get('games/overview', 'CPanel\GameController@overview');
    Route::resource('games', 'CPanel\GameController');

    // Sources
    Route::get('sources/overview', 'CPanel\SourceController@overview');
    Route::resource('sources', 'CPanel\SourceController');

    // Contents
    Route::get('contents/overview', 'CPanel\ContentController@overview');
    Route::resource('contents', 'CPanel\ContentController');

    // Famobi
    Route::get('source/famobi', 'CPanel\Source\FamobiController@index');

    // ClickJogos
    Route::get('source/clickjogos/categories', 'CPanel\Source\ClickJogosController@categories');
    Route::get('source/clickjogos/games', 'CPanel\Source\ClickJogosController@games');
});