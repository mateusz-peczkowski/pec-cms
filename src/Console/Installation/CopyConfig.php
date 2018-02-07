<?php

namespace peczis\pecCms\Console\Installation;

class CopyConfig
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

        $this->command->line('Updating Configuration Files: <info>✔</info>');
    }

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        if (file_exists(config_path('pec-cms.php')) && !$this->command->confirm('You have already installed pec-cms config. Do you want to override it?')) {
            return;
        }

        copy(PEC_CMS_PATH.'/config/pec-cms.php', config_path('pec-cms.php'));
    }

}
