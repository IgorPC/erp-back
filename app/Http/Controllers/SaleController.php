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
        Expected JSON
        {
          "client_id": 1, //Client id
          "total": 0, // Total after discounts
          "discount": 0, //Total of discounts (in dollars)
          "products": [
            {
              "product_id": 1, //product id
              "price": 0, // Original price at the moment
              "discount": 0, // Total of discount for that product in percentage
              "final_price": 0 // Product Price after discount
            },
            {
              "product_id": 2,
              "price": 0,
              "discount": 0,
              "final_price": 0
            }
          ]
        }

        */
        try {
            $body = [
                "client_id" => $request->input('client_id'),
                "total" => $request->input('total'),
                "discount" => $request->input('discount'),
                "products" => $request->input('products')
            ];

            dd($body);
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
