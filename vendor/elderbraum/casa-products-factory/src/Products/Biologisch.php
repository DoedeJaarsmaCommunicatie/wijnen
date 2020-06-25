<?php
namespace Elderbraum\CasaProductFactory\Products;

class Biologisch extends Product {
	/**
	 * Biologisch constructor.
	 */
	public function __construct() {
		$this->add_args(
			[
				'product_tag' => 'biologisch',
			]
		);
	}
}
