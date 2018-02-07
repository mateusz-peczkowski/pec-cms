<?php

namespace peczis\pecCms\Console\Commands;

use Illuminate\Console\Command;
use peczis\pecCms\Console\Installation;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pec-cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install pec-CMS backend into your Laravel App';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $installers = collect([
            Installation\CopyConfig::class,
            Installation\DistLink::class,
            Installation\SetupAuthConfig::class,
        ]);

        $installers->each(function ($installer) { (new $installer($this))->install(); });

        $this->comment('CMS installed. Create something amazing!');

        if ($this->ask('Did you want to add new user to pec-CMS?', 'yes')) {
            $this->call('pec-cms:admin');
        }

        return;
    }
}
