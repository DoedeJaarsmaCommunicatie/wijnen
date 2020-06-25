<?php
namespace Elderbraum\CasaProductFactory;

final class ProductsFactory {
	public static function create($class) {
		return new $class();
	}
}
