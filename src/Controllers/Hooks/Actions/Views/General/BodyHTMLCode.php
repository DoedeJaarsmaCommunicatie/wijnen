<?php

namespace App\Controllers\Hooks\Actions\Views\General;

use App\Controllers\Hooks\Actions\Action;

class BodyHTMLCode extends Action
{
	public function action(): void
	{
		print \get_theme_mod('code_body_html');
	}

	public function hook(): string
	{
		return 'winc/html/body/pre';
	}

}
