<?php
namespace Elderbraum\CasaProductFactory\Products;


class Awarded extends Product {
	public function __construct() {
		$this->add_args(
			[
				'product_tag' => 'prijswinnaar',
			]
		);
	}
}
