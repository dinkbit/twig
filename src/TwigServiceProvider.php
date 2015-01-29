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
use Illuminate\View\ViewServiceProvider as ServiceProvider;
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
        //
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

            $twig = new Twig($this->app['twig.loader'], [
                'cache' => $cache,
                'debug' => $debug,
                'auto_reload' => true,
            ]);

            if ($debug) {
                $twig->addExtension(new Twig_Extension_Debug);
            }

            return new TwigEngine($twig);
        });
    }
}
