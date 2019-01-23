<?php
/**
 * @copyright Copyright (c) 2018 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larvacent.com/
 * @license http://www.larvacent.com/license/
 */

namespace Larva\Client;

use Illuminate\Support\ServiceProvider;

/**
 * Class LarvaServiceProvider
 *
 * @author Tongle Xu <xutongle@gmail.com>
 */
class LarvaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__ . '/../config/larva.php') ?: $raw;

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $source => config_path('larva.php'),
            ], 'larva-config');
        }

        $this->mergeConfigFrom($source, 'larva');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('larva', function ($app) {
            return new LarvaManage(config('larva'));
        });
    }
}
