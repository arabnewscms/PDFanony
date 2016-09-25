<?php

namespace PDFAnony\TCPDF;

use Config;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class AnonyServiceProvider
 * @version 1.0
 * @package PDFAnony\TCPDF
 */
class AnonyServiceProvider extends LaravelServiceProvider
{
	protected $config_setup = [
		'K_PATH_FONTS' => 'font_path',
		'K_PATH_IMAGES' => 'image_path',
		'K_TCPDF_THROW_EXCEPTION_ERROR' => 'throw_exception_enable'
	];

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
		if(!file_exists(base_path('config').'/pdfanony.php'))
		{
		    $this->publishes([__DIR__.'/config' => base_path('config'),]);
		}


		$this->app->singleton('tcpdf', function ($app) {
			return new TCPDF($app);
		});
	}

	public function boot()
	{
		if (!defined('K_TCPDF_EXTERNAL_CONFIG')) {
			define('K_TCPDF_EXTERNAL_CONFIG', true);
		}
		foreach ($this->config_setup as $key => $value) {
			$value = Config::get('pdfanony.' . $value, null);
			if (!is_null($value) && !defined($key)) {
				if (is_string($value) && strlen($value) == 0) {
					continue;
				}
				define($key, $value);
			}
		}
		
		if(!file_exists(base_path('config').'/pdfanony.php'))
		{
		    $this->publishes([__DIR__.'/config' => base_path('config'),]);
		}

	}

	public function provides()
	{
		return ['pdf'];
	}
}