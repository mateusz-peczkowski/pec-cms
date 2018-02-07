<?php

namespace peczis\pecCms\Console\Installation;

class SetupAuthConfig
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

        $this->command->line('Setting up auths configs: <info>✔</info>');
    }

    /**
     * Install the components.
     *
     * @return void
     */
    public function install()
    {
        $config = config_path('auth.php');
        if (file_exists($config)) {
            $str = require $config;

            $str['guards']['pecCms'] = [
                'driver' => 'session',
                'provider' => 'pec_users',
            ];

            $str['providers']['pec_users'] = [
                'driver' => 'eloquent',
                'model' => 'peczis\pecCms\Models\User'
            ];

            $str['passwords']['pec_users'] = [
                'provider' => 'pec_users',
                'table' => PEC_CMS_PREFIX . 'password_resets',
                'expire' => 120
            ];

            file_put_contents($config, '<?php return ' . var_export($str, true) . ';');
        } else {
            $this->command->comment('You dont have auth file at you config directory');
        }
    }

}
