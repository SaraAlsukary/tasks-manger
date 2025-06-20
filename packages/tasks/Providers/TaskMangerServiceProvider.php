<?php

namespace Package\Tasks\Providers;
use Illuminate\Support\Facades\Route;

use illuminate\Support\ServiceProvider;


class TaskMangerServiceProvider extends ServiceProvider
{
        public function boot(){

            //    $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
               $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
               $this->loadViewsFrom(__DIR__.'/../views','Package/Tasks');
            //    Route::middleware(['api'])->group(__DIR__.'/../routes/api.php');
                   Route::prefix('api')
                   ->middleware('api')
                   ->group(function () {
                   require __DIR__.'/../routes/api.php';
                   });
            //    $this->registerVueComponents();
        }

         public function register(){

        }


           /**
           * Register Vue components
           */
        //    protected function registerVueComponents()
        //    {
        //             $this->publishes([
        //             __DIR__.'/../resources/js/components' => resource_path('js/components/news'),
        //             ], 'vue-components');

        //             $this->publishes([
        //             __DIR__.'/../resources/js/router' => resource_path('js/router'),
        //             ], 'vue-router');
        //    }
}
