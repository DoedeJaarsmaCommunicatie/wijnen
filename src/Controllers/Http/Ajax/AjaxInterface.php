<?php

namespace App\Controllers\Http\Ajax;

interface AjaxInterface
{
	/**
	 * Returns true if no 'nopriv' ajax entry point should be made.
	 *
	 * @return bool
	 */
	public function isPrivate(): bool;
	public function actionName(): string;
	public function hookName(): string;
}
