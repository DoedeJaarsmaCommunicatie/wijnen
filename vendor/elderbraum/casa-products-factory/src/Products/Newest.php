<?php
namespace Elderbraum\CasaProductFactory\Products;

/**
 * Class Newest
 *
 * @package Elderbraum\CasaProductFactory\Products
 */
class Newest extends Product {
	
	/**
	 * Newest constructor.
	 */
	public function __construct() {
		$this->add_args(
			[
				'orderby'        => 'date',
				'order'          => 'DESC',
			]
		);
	}
}
