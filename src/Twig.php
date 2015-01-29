<?php

/*
* This file is part of Laravel Artisans.
*
* (c) Joseph Cohen <joseph.cohen@dinkbit.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace Artisans\Twig;

use Illuminate\View\Compilers\CompilerInterface;
use Twig_Environment;
use Twig_LoaderInterface;

/**
 * This is the twig class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class Twig extends Twig_Environment {

    public function __construct(Twig_LoaderInterface $loader = null, $options = [])
    {
        parent::__construct($loader, $options);
    }

}
