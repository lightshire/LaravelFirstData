<?php namespace Imcorleone\LaravelFirstData;

use Illuminate\Support\ServiceProvider;

class LaravelFirstDataServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['firstdata'] = $this->app->share(function($app) {
			return new FirstData();
		});
	}

	public function boot()
	{
		$this->package("imcorleone/laravel-first-data");
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
