<?php

namespace App\Providers;

use App\Advertisement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($settings){
            $settings->with('settings', DB::select('select * from settings where id=?',[1]));
            $settings->with('pagesettings', DB::select('select * from page_settings where id=?',[1]));
            $settings->with('sociallinks', DB::select('select * from social_links where id=?',[1]));
            $settings->with('sliders', DB::select('select * from sliders'));
            $settings->with('code', DB::select('select * from code_scripts'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
