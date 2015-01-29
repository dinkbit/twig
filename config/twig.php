<?php
/*
 * This file is part of Laravel Twig.
 *
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Enabled Laravel Twig extensions
    |--------------------------------------------------------------------------
    |
    | The extensions listed here will be automatically loaded on the Twig
    | compiler for your views. Feel free to add your own extensions to
    | this array to extend functionality to your views.
    |
    */

    'extensions' => [
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
