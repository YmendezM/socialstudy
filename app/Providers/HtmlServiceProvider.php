<?php
namespace TeachMe\Providers;
use Collective\Html\HtmlServiceProvider as CollectiveHmtlServiceProvider; 
use TeachMe\Components\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHmtlServiceProvider 
{

	/**
	 * Register the HTML builder instance.
	 *
	 * @return void
	 */
	protected function registerHtmlBuilder()
	{
		$this->app->bindShared('html', function($app)
		{
			return new HtmlBuilder($app['config'], $app['view'], $app['url']);
		});
	}

}