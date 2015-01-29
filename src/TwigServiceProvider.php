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

use Artisans\Twig\TwigBridge;
use Artisans\Twig\TwigEngine;
use Artisans\Twig\Extensions\LaravelExtension;
use Illuminate\View\ViewServiceProvider as ServiceProvider;
use InvalidArgumentException;
use Twig_Loader_Filesystem;
use Twig_Extension_Debug;

/**
 * This is the twig service provider class.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
class TwigServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/twig.php');

        $this->publishes([$source => config_path('twig.php')]);

        $this->mergeConfigFrom($source, 'twig');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerTwig();

        $this->app['view']->addExtension('twig', 'twig');
    }

    /**
    * Register the Twig engine implementation.
    *
    * @param  \Illuminate\View\Engines\EngineResolver  $resolver
    *
    * @return void
    */
    public function registerTwig()
    {
        $this->app->singleton('twig.loader', function ($app)
        {
            return new Twig_Loader_Filesystem($app->view->getFinder()->getPaths());
        });

        $this->app['view.engine.resolver']->register('twig', function() {

            $debug = $this->app->config->get('app.debug');
            $cache = $this->app->config->get('view.compiled').'/twig';
            $environment = $this->app->config->get('twig.environment');

            $default = [
                'cache' => $cache,
                'debug' => $debug,
            ];

            $twig = new Twig($this->app['twig.loader'], array_merge($default, $environment));

            $extensions = array_merge(
                [new LaravelExtension($this->app->config->get('twig.helpers'))],
                $this->app->config->get('twig.extensions')
            );

            foreach ($extensions as $extension)
            {
                $twig->addExtension($extension);
            }

            if ($debug) {
                $twig->addExtension(new Twig_Extension_Debug);
            }

            return new TwigEngine($twig);
        });
    }

    /**
    * Register Twig extensions.
    *
    * @return void
    */
    public function registerLaravelhelpers()
    {
        $this->app->bindIf('twig.extensions', function ($app) {
            return [];
        });
    }

    /**
    * Get registered extensions.
    *
    * @param  string|function|Twig_Extension $extension
    *
    * @throws \InvalidArgumentException
    *
    * @return string|function|Twig_Extension
    */
    protected function getExtension($extension)
    {
        if (is_string($extension))
        {
            $extension = $this->app->make($extension);
        }
        elseif (is_callable($extension))
        {
            $extension = $this->app->call($extension);
        }
        elseif (! is_a($extension, 'Twig_Extension'))
        {
            throw new InvalidArgumentException('Invalid Twig extension, it must be a string, callable or extend "Twig_Extension"');
        }

        return $extension;
    }
}
