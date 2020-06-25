<?php


namespace App\Controllers\Http\Api\v1\Shop;

use App\Controllers\Http\Api\RestController;

class GetProductData extends RestController
{
    public function endpoint(): string
    {
        return 'shop/product/(?P<product_id>\d+)';
    }

    public function methods(): array
    {
        return [
            [
                'methods' => \WP_REST_Server::READABLE,
                'callback' => [$this, 'get_product_data'],
                'permission_callback' => [$this, 'get_product_data_permission_callback'],
                'args' => [
                    'product_id' => [
                        'required' => true
                    ]
                ]
            ]
        ];
    }

    /**
     * @param \WP_REST_Request $request
     *
     * @return \WP_REST_Response|\WP_Error
     */
    public function get_product_data(\WP_REST_Request $request)
    {
        $response = new \WP_REST_Response();
        $params = $request->get_params();

        try {
            $product = new \App\Models\Product($params['product_id']);
        } catch (\Exception $e) {
            return new \WP_Error('PRODUCT_NOT_FOUND', "Product with product_id {$params['product_id']} not found", ['status' => 404]);
        }

        $response->set_data([
            'product' => $product
        ]);

        return $response;
    }

    public function get_product_data_permission_callback()
    {
        return true;
    }
}
