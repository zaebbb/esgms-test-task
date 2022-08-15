<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . "/Helpers/ReturnApi.php";
        require_once app_path() . "/Helpers/GenreHelper/ViewGenreHelper.php";
        require_once app_path() . "/Helpers/GenreHelper/DeleteGenreHelper.php";
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
