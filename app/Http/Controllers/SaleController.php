<?php

namespace App\Http\Controllers;

use App\Http\Services\SaleService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function Create(Request $request)
    {
        /**
        * Expected JSON
          * {
              * "client_id": 1, //Client id
              * "total": 170.64, // Total after discounts
              * "discount": 9.36, //Total of discounts (in dollars)
              * "created_by": 11, //User who sold the products
              * "products": [
                  * {
                      * "product_id": 26, //product id
                      * "price": 84, // Original price at the moment
                      * "discount": 5, // Total of discount for that product in percentage
                      * "quantity": 2, // Amount of units
                      * "final_price": 79.80 // Product Price after discount
                  * },
                  * {
                      * "product_id": 24,
                      * "price": 12,
                      * "discount": 8,
                      * "quantity": 1,
                      * "final_price": 11.04
                  * }
             * ]
          * }
        */
        try {
            $body = [
                "client_id" => $request->input('client_id'),
                "total" => $request->input('total'),
                "products" => $request->input('products'),
                "created_by" => $request->input('created_by')
            ];

            return response()->json($this->saleService->newSale(
                $body['client_id'],
                $body['total'],
                $body['products'],
                $body['created_by']
            ));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }
}
