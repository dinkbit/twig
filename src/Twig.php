<?php

/*
 * This file is part of Dinkbit Twig.
 *
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dinkbit\Twig;

use Twig_Environment;
use Twig_LoaderInterface;

/**
 * This is the twig class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class Twig extends Twig_Environment
{
    public function __construct(Twig_LoaderInterface $loader = null, $options = [])
    {
        parent::__construct($loader, $options);
    }
}
