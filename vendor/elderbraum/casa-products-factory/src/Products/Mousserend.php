<?php
namespace Elderbraum\CasaProductFactory\Products;

class Mousserend extends Product {
	/**
	 * Mousserend constructor.
	 */
	public function __construct() {
		$this->add_args(
			[
				'tax_query'      => [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => 'mousserend',
					],
				],
			]
		);
	}
}
