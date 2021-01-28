<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class WidgetProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// ------------------------------------------- VENDORS -------------------------------------------
		$namespace = 'App\Http\ViewComposers\Vendor\\';
		View::composer([
							'admin.cards.vendor.search',
							'admin.cards.vendor.simple_list',
						], $namespace . 'SearchComposer');
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
