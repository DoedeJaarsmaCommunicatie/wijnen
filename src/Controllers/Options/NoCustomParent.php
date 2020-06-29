<?php

namespace App\Controllers\Options;

trait NoCustomParent
{
	public function custom_parent()
	{
		return false;
	}
}
