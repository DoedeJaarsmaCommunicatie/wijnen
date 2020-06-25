<?php
namespace Elderbraum\CasaProductFactory\Products;

use WP_Query;

/**
 * Class Product
 */
abstract class Product {
	
	/**
	 * A \WP_Query instance.
	 *
	 * @see \WP_Query
	 *
	 * @var WP_Query $query
	 */
	public $query;
	
	/**
	 * New query args
	 *
	 * @var array
	 */
	protected $query_args = [];
	
	/**
	 * If this is false, defaults are not merge with new args.
	 *
	 * @var bool
	 */
	private $use_defaults = true;
	
	/**
	 * The default query args.
	 *
	 * @var array
	 */
	private static $defaults = [
		'post_type'   => 'product',
		'post_status' => 'publish',
		'fields'      => 'ids',
	];
	
	/**
	 * Turn off defaults.
	 */
	public function no_defaults(): self {
		$this->use_defaults = false;
		
		return $this;
	}
	
	/**
	 * Merges the query args.
	 */
	private function merge_args(): void {
		if ( $this->use_defaults ) {
			$this->query_args = array_merge( self::$defaults, $this->query_args );
		}
	}
	
	/**
	 * Adds arguments to the default query args.
	 *
	 * @param array $args New arguments to add to the query args.
	 *
	 * @return Product
	 */
	public function add_args( $args ): self {
		$this->query_args = array_merge( self::$defaults, $this->query_args, $args );
		
		return $this;
	}
	
	/**
	 * Boots the process
	 *
	 * @return Product
	 */
	public function boot(): self {
		$this->merge_args();
		
		return $this;
	}
	
	/**
	 * Initialize the query with the current $query_args.
	 *
	 * @return $this
	 */
	public function initialize_query() {
		$this->query = new WP_Query( $this->query_args );
		
		return $this;
	}
	
	/**
	 * Only get the args.
	 *
	 * @return array
	 */
	public function get_args(): array {
		return $this->query_args;
	}
	
	/**
	 * Adds a post limit Default = 4.
	 *
	 * @param int $limit The limit default = 4.
	 *
	 * @return Product
	 */
	public function limit( int $limit = 4 ): self {
		$this->add_args(
			[
				'posts_per_page' => $limit,
			]
		);
		return $this;
	}
	
	/**
	 * Only get the WP_Query instance.
	 *
	 * @return WP_Query
	 */
	public function get_wp_query(): WP_Query {
		return $this->query;
	}
}
