<?php

/*
 * This file is part of Laravel Multialerts.
 *
 * (c) Gustavo Meireles <gustavo@gsmeira.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Session Key
    |--------------------------------------------------------------------------
    |
    | Name that will be used to store the alerts in the session. This option
    | can be changed if it conflicts with any other session key.
    |
    */

    'session_key' => 'multialerts',

    /*
    |--------------------------------------------------------------------------
    | View Key
    |--------------------------------------------------------------------------
    |
    | Name of the variable that will be used to store the alerts in the view.
    | This option can be changed if it conflicts with any other variable
    | names of your views.
    |
    */

    'view_key' => 'multialerts',

    /*
    |--------------------------------------------------------------------------
    | Levels
    |--------------------------------------------------------------------------
    |
    | Here you can define an array with the available alert levels. Feel
    | free to add, remove or change this option with the values that
    | fit better your application.
    |
    */

    'levels' => [
        'success',
        'warning',
        'danger',
        'info',
    ],

];
