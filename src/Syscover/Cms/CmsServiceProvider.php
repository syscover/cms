<?php namespace Syscover\Plantilla;

use Illuminate\Support\ServiceProvider;
use Syscover\Pulsar\Libraries\CustomValidator;

class CmsServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// include route.php file
		include realpath(__DIR__ . '/../../routes.php');

		// register views
		$this->loadViewsFrom(realpath(__DIR__ . '/../../views'), 'cms');

        // register translations
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../../lang'), 'cms');

		// register public files
		$this->publishes([
			realpath(__DIR__ . '/../../../public') => public_path('/packages/syscover/cms')
		]);

		// register config files
		$this->publishes([
			realpath(__DIR__ . '/../../config/cms.php') => config_path('cms.php')
		]);

        // register migrations
        $this->publishes([
            __DIR__.'/../../database/migrations/' => base_path('/database/migrations')
        ], 'migrations');

        // register migrations
        $this->publishes([
            __DIR__.'/../../database/seeds/' => base_path('/database/seeds')
        ], 'seeds');
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

}
