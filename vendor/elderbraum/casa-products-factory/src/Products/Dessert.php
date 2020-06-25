<?php
namespace Elderbraum\CasaProductFactory\Products;

class Dessert extends Product {
	/**
	 * White constructor.
	 */
	public function __construct() {
		$this->add_args(
			[
				'tax_query'      => [
					[
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => 'dessert',
					],
				],
			]
		);
	}
}
