<?php

namespace peczis\pecCms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
//
use peczis\pecCms\Console\Commands\InstallCommand;
use peczis\pecCms\Console\Commands\UserAddCommand;
//
use peczis\pecCms\Middleware\AuthenticateMiddleware;
use peczis\pecCms\Middleware\ChangeGuardMiddleware;
//
use peczis\pecCms\Models\User;
use peczis\pecCms\Models\PasswordReset;
//
use peczis\pecCms\Observers\UserObserver;
use peczis\pecCms\Observers\PasswordResetObserver;
//
use peczis\pecCms\Repositories\User\UserCacheDecorator;
use peczis\pecCms\Repositories\PasswordReset\PasswordResetCacheDecorator;
//
use peczis\pecCms\Facades\PecCms as PecCmsFacade;

class PecCmsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->defineRoutes();

        $this->loadResources();

        $this->loadObservers();

        if (app()->version() >= 5.4) {
            $router->aliasMiddleware('pec-cms.auth', AuthenticateMiddleware::class);
            $router->aliasMiddleware('changeGuard', ChangeGuardMiddleware::class);
        } else {
            $router->middleware('pec-cms.auth', AuthenticateMiddleware::class);
            $router->middleware('changeGuard', ChangeGuardMiddleware::class);
        }
    }

    /**
     * Define the routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        if (! $this->app->routesAreCached()) {
            Route::middleware(['web', 'changeGuard'])
                ->namespace('peczis\pecCms\Controllers')
                ->prefix(PEC_CMS_ROUTE_PREFIX)
                ->group(__DIR__.'/./Routes/web.php');
        }
    }

    /**
     * Define the observers.
     *
     * @return void
     */
    protected function loadObservers()
    {
        User::observe(UserObserver::class);
        PasswordReset::observe(PasswordResetObserver::class);
    }

    /**
     * Define the repositories.
     *
     * @return void
     */
    protected function loadRepositories()
    {
        // CACHE init
        $this->app->bind('peczis\pecCms\Services\Contracts\CacheInterface', function($app) {
            return new \peczis\pecCms\Services\Cache\LaravelCache($app['cache'], null, 60);
        });

        // User
        $this->app->bind('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface', function($app) {
            $model =  new \peczis\pecCms\Repositories\User\EloquentUserRepository($app);

            return new UserCacheDecorator($model, ['model', 'updater'], $this->app->make('peczis\pecCms\Services\Contracts\CacheInterface'));
        });

        // PasswordReset
        $this->app->bind('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface', function($app) {
            $model =  new \peczis\pecCms\Repositories\PasswordReset\EloquentPasswordResetRepository($app);

            return new PasswordResetCacheDecorator($model, ['model', 'updater'], $this->app->make('peczis\pecCms\Services\Contracts\CacheInterface'));
        });
    }

    /**
     * Define the resources for the package.
     *
     * @return void
     */
    protected function loadResources()
    {
        $this->loadViewsFrom(PEC_CMS_PATH.'/resources/views', 'pec-cms');

        $this->loadTranslationsFrom(PEC_CMS_PATH.'/resources/lang', 'pec-cms');

        $this->loadMigrationsFrom(PEC_CMS_PATH.'/migrations/');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                PEC_CMS_PATH.'/config/pec-cms.php' => config_path('pec-cms.php'),
            ], 'pec-cms');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('pecCms', PecCmsFacade::class);

        $define = require(__DIR__ . '/../config/pec-define.php');

        foreach($define as $key => $value)
        {
            if (! defined($key)) {
                define($key, $value);
            }
        }

        $this->activateConfig('pec-cms');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UserAddCommand::class
            ]);
        }

        $this->loadRepositories();
    }

    protected function activateConfig($slug)
    {
        if (file_exists(config_path($slug . '.php'))) {
            $this->mergeConfigFrom(
                PEC_CMS_PATH.'/config/' . $slug . '.php', $slug
            );
        } else {
            if ($this->app['config']->get($slug) === null) {
                $this->app['config']->set($slug, require PEC_CMS_PATH.'/config/' . $slug . '.php');
            }
        }
    }
}
