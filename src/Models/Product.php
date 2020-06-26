<?php

namespace App\Models;

use WC_Product;
use Timber\Post;
use Timber\Term;
use Timber\PostQuery;
use WC_Product_Attribute;

class Product extends Post
{
    protected const VIVINO_PRICE_META = '_vivino_pricing';

    /**
     * @var WC_Product|null $product
     */
    public $product = null;
    protected static $price_cache = [];
    protected static $sale_price_cache = [];

    protected static $categories_cache = [];
    protected static $attributes_cache = [];

    protected static $stock_cache = [];

    protected static $related_cache = [];
    protected static $product_cache = [];

    protected static $gallery_id_cache = [];

    public function get_price()
    {
        if (isset(static::$price_cache[$this->id])) {
            return static::$price_cache[$this->id];
        }

        $this->setProduct();

        return static::$price_cache[$this->id] = wc_price($this->product->get_regular_price());
    }

    public function get_title()
    {
        return $this->title();
    }

    public function get_sale_price()
    {
        if (isset(static::$sale_price_cache[$this->id])) {
            return static::$sale_price_cache[$this->id];
        }

        $this->setProduct();

        return static::$sale_price_cache[$this->id] = $this->product->get_sale_price();
    }

    public function get_attributes()
    {
        if (isset(static::$attributes_cache[$this->id])) {
            return static::$attributes_cache[$this->id];
        }
        $this->setProduct();

        /** @var WC_Product_Attribute $attribute */
        foreach ($this->product->get_attributes() as $attribute) {
            if (!$attribute->get_visible()) {
                continue;
            }
            $name = $attribute->get_name();
            static::$attributes_cache[$this->id] [$name] = [
                'name' => str_replace('-', ' ', str_replace('pa_', '', $name)),
                'options' => array_map(static function ($item) {
                    return new Term($item);
                }, $attribute->get_options()),
            ];
        }

        return static::$attributes_cache[$this->id];
    }

    public function is_on_sale()
    {
        $this->setProduct();

        return $this->product->is_on_sale() || $this->has_vivino_markup();
    }

    public function has_vivino_markup()
    {
        return (bool) $this->setProduct()->get_meta(static::VIVINO_PRICE_META);
    }

    /**
     * @return string
     *
     * @deprecated
     */
    public function get_vivino_markup()
    {
        return '&euro;' . $this->setProduct()->get_meta(static::VIVINO_PRICE_META);
    }

    public function is_in_stock()
    {
        if (isset(static::$stock_cache[$this->id]['in_stock'])) {
            return static::$stock_cache[$this->id]['in_stock'];
        }

        $this->setProduct();

        return static::$stock_cache[$this->id]['in_stock'] = $this->product->is_in_stock();
    }

    public function can_backorder()
    {
        if (isset(static::$stock_cache[$this->id]['on_backorder'])) {
            return static::$stock_cache[$this->id]['on_backorder'];
        }

        $this->setProduct();

        return static::$stock_cache[$this->id]['on_backorder'] = $this->product->backorders_allowed();
    }

    public function related_products()
    {
        if (!isset(static::$related_cache[$this->id])) {
            static::$related_cache[$this->id] = wc_get_related_products($this->id, 3);
        }

        return new PostQuery(static::$related_cache[$this->id], __CLASS__);
    }

    public function gallery_items()
    {
        if (isset(static::$gallery_id_cache[$this->id])) {
            return static::$gallery_id_cache[$this->id];
        }

        $this->setProduct();

        return static::$gallery_id_cache[$this->id] = $this->product->get_gallery_image_ids();
    }

    public function setProduct(): \WC_Product
    {
    	if (!$this->ID) {
    		$this->ID = get_queried_object_id();
	    }

        if ($this->product === null) {
            if (isset(static::$product_cache[$this->ID])) {
                $this->product = static::$product_cache[$this->ID];
            } else {
                $this->product = static::$product_cache[$this->ID] = wc_get_product($this->ID);
            }
        }

        return $this->product;
    }

    public function __call($field, $args)
    {
        return @call_user_func_array([$this->setProduct(), $field], $args);
    }
}
