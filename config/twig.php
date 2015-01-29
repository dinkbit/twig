<?php

/*
 * This file is part of Dinkbit Twig.
 *
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Override Twig Environment
    |--------------------------------------------------------------------------
    |
    | The options listed here will be override the loaded environment on
    | Twig compiler. Feel free to add your own options to this array
    | to override any specific functionality of Twig.
    |
    */

    'environment' => [
        'charset' => 'utf-8',
        'auto_reload' => true,
        'strict_variables' => false,
        'autoescape' => true,
        'optimizations' => -1
    ],

    /*
    |--------------------------------------------------------------------------
    | Enabled Twig extensions
    |--------------------------------------------------------------------------
    |
    | The extensions listed here will be automatically loaded on the Twig
    | compiler for your views. Feel free to add your own extensions to
    | this array to extend functionality to your views.
    |
    */

    'extensions' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Enabled Laravel helpers
    |--------------------------------------------------------------------------
    |
    | The Laravel helpers listed here will be automatically loaded on Twig
    | compiler for your views. Feel free to add your own helpers to
    | this array to extend functionality to your views.
    |
    */

    'helpers' => [
        'dump',
        'csrf_token',
        'route',
        'action',
        'url',
        'secure_url',
        'asset',
        'secure_asset',
    ],
];
