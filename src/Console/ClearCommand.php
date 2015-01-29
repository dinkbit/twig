<?php

/*
* This file is part of Laravel Artisans.
*
* (c) Joseph Cohen <joseph.cohen@dinkbit.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace Artisans\Twig\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Twig_Environment;

class ClearCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'twig:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear twig cached files';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $twig;

    /**
     * Create a new config clear command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     *
     * @return void
     */
    public function __construct(Filesystem $files, Twig_Environment $twig)
    {
        parent::__construct();

        $this->files = $files;
        $this->twig = $twig;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $cacheDir = $this->twig->getCache();

        $this->files->deleteDirectory($cacheDir);

        if($this->files->exists($cacheDir)) {
            $this->error('Could not clear Twig Cache.');
        } else {
            $this->info('Twig cached views cleared!');
        }
    }

}
