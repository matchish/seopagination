<?php

namespace Matchish\SeoPagination;

use Illuminate\Support\ServiceProvider;

class SeoPaginationServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('seopagination', function($app)
            {
                return new SeoPagination();
            });
        \Blade::directive('metaYandex', function($expression) {
            return "<?php echo app('seopagination')->getYandexMetaTag(); ?>";
        });
        \Blade::directive('canonical', function($expression) {
            return "<?php echo app('seopagination')->getCanonicalMetaTag(); ?>";
        });
        \Blade::directive('seoPaginationPrev', function($expression) {
            return "<?php echo app('seopagination')->getPrevLink(); ?>";
        });
        \Blade::directive('seoPaginationNext', function($expression) {
            return "<?php echo app('seopagination')->getNextLink(); ?>";
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}