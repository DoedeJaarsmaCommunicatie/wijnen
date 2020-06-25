<?php

namespace App\Controllers\Resources\Api;

use Timber\Image;

class Product
{
	/** @var \App\Models\Product $product */
	private $product;

	/** @var Image */
	private $thumbnail;

	public function __construct (\App\Models\Product $product, array $cartItem)
	{
		$this->product = $product;
		$this->thumbnail = $product->thumbnail();
		$this->cartItem = $cartItem;
	}

	public function toArray()
	{
		return [
			'id' => $this->product->id,
			'name' => $this->product->name(),
			'price' => $this->product->get_price_bare(),
			'thumbnail' => $this->thumbnail,
			'cart' => $this->cartItem,
		];
	}


}
