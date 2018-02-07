<?php

namespace peczis\pecCms\Console\Installation;

use Illuminate\Filesystem\Filesystem;

class DistLink
{
    /**
     * The console command instance.
     *
     * @var \Illuminate\Console\Command  $command
     */
    protected $command;

    /**
     * Create a new installer instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function __construct($command)
    {
        $this->command = $command;

        $this->command->line('Linking assets: <info>✔</info>');
    }

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        if (file_exists(public_path('vendor/pec-cms'))) {
            return;
        }

        (new Filesystem)->makeDirectory(
            public_path('vendor'), $mode = 0755, $recursive = true
        );

        (new Filesystem)->link(
            PEC_CMS_PATH . '/resources/dist', public_path('vendor/pec-cms')
        );
    }

}
