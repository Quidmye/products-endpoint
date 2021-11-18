<?php

namespace Quidmye\ProductsEndpoint\Providers;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider{

    public function register(){

    }

    public function boot(){
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ProductsEndpoint');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

}