<?php

namespace App\Controllers\Http;

use Symfony\Component\HttpFoundation\Request;

abstract class Controller
{
	protected function getRequest(): Request
	{
		return Request::createFromGlobals();
	}

	protected function getRequestWithJson(): Request
	{
		$request = Request::createFromGlobals();

		$data = json_decode($request->getContent(), true);
		$request->request->replace(is_array($data) ? $data : []);

		return $request;
	}
}
