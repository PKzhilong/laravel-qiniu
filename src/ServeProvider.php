<?php

namespace Laravel\QiNiu;

use Illuminate\Support\ServiceProvider;

class ServeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/qiniu.php' => config_path('qiniu.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('qiNiuUpload', function(){
           return new QiNiuInstance();
        });
        $this->mergeConfigFrom(__DIR__ . '/config/qiniu.php', 'qiniu');
    }
}
