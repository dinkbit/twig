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

use Illuminate\View\Engines\EngineInterface;
use InvalidArgumentException;
use Twig_Environment;
use Twig_Error_Loader;
use Twig_Template;

/**
 * This is the twig engine class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class TwigEngine implements EngineInterface
{
    /**
     * Twig enviroment instance.
     *
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * Creates a twig engine instance.
     *
     * @param \Twig_Environment $environment
     *
     * @return void
     */
    public function __construct(Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param string $path
     * @param array  $data
     *
     * @return string
     */
    public function get($path, array $data = [])
    {
        return $this->load($path)->render($data);
    }

    /**
     * Loads the given template.
     *
     * @param string|TemplateReferenceInterface|\Twig_Template $path
     *
     * @throws \InvalidArgumentException
     *
     * @return \Twig_TemplateInterface
     */
    protected function load($path)
    {
        if ($path instanceof Twig_Template) {
            return $path;
        }

        try {
            return $this->environment->loadTemplate((string) basename($path));
        } catch (Twig_Error_Loader $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
