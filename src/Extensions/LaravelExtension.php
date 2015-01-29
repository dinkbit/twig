<?php

/*
* This file is part of Laravel Artisans.
*
* (c) Joseph Cohen <joseph.cohen@dinkbit.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace Artisans\Twig\Extensions;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * This is the laravel extension loader class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class LaravelExtension extends Twig_Extension {

    /**
     * Laravel extensions.
     *
     * @var string[]
     */
    protected $extensions;

    /**
     * Creates a new instance of laravel extensions
     *
     * @param array $extensions
     */
    public function __construct($extensions = [])
    {
        $this->extensions = $extensions ?: [];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'artisans.laravel_extensions';
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions()
    {
        $functions = [];

        foreach ($this->extensions as $extension) {
            $functions[] = new Twig_SimpleFunction($extension, $extension);
        }

        return $functions;
    }

}
