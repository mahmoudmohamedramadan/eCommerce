<?php

namespace App\Providers;

use App\Models\Languages;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('admin.languages.index',function($view){
            $view->with(['languages' => Languages::paginate(PAGINATION_COUNT) ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
