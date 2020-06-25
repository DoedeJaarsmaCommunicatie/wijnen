<?php

namespace App\Controllers\Http\Api\v1\Shop;

use App\Controllers\Http\Api\RestController;

class GetRelatedProducts extends RestController
{

    public function endpoint(): string
    {
        return 'shop/related/(?P<product_id>\d+)';
    }

    public function methods(): array
    {
        return [
            [
                'methods' => \WP_REST_Server::READABLE,
                'callback' => [$this, 'get_related_products'],
                'permission_callback' => [$this, 'get_related_products_permission_callback'],
                'args' => [
                    'product_id' => [
                        'required' => true
                    ],
                ],
            ]
        ];
    }

    /**
     * @param \WP_REST_Request $request
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function get_related_products(\WP_REST_Request $request)
    {
        $response  = new \WP_REST_Response();
        $params = $request->get_params();

        // Query params
        $limit = $params['limit']?? 3;
        $not_in = explode(';', $params['not_in']?? '') ;
        $current_product = $params['product_id']?? false;

        if (!$current_product) {
            return new \WP_Error('NO_PRODUCT_ID', 'Product ID not supplied', ['status' => 400]);
        }

        $related_ids = wc_get_related_products(
            $current_product,
            $limit,
            $not_in
        );

        $response->set_data([
            'product_ids' => $related_ids,
            'limit' => $limit,
            'count' => count($related_ids),
            'not_in' => $not_in,
            'current_product' => (int) $current_product
        ]);

        return $response;
    }

    public function get_related_products_permission_callback()
    {
        return true;
    }
}
