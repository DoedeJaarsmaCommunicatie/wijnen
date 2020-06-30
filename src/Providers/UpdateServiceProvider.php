<?php

namespace App\Providers;

use App\Helpers\WP;

class UpdateServiceProvider extends ServiceProvider
{
	public function register()
	{
		\Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/DoedeJaarsmaCommunicatie/wijnen',
			WP::getStylesheetDir() . '/functions.php',
			'wijnen'
		);
	}
}
