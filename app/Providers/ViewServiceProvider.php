<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Note;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->notification_count();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function notification_count()
    {
	    
    }
}
