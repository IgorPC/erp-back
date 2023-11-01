<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function List(Request $request)
    {
        try {
            $body = [
                "page" => $request->get('page'),
                "rows" => $request->get('rows')
            ];

            return response()->json($this->productService->listWithPagination($body['rows'], $body['page']));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function Create(Request $request)
    {
        try {
            $body = [
                "user_id" => $request->input('user_id'),
                "name" => $request->input('name'),
                "code" => $request->input('code'),
                "price" => $request->input('price'),
                "quantity" => $request->input('quantity')
            ];

            return response()->json($this->productService->createProduct($body));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function Update($productId, Request $request)
    {
        try {
            $body = [
                "status_id" => $request->input('status_id'),
                "name" => $request->input('name'),
                "code" => $request->input('code'),
                "price" => $request->input('price'),
                "quantity" => $request->input('quantity')
            ];

            return response()->json($this->productService->updateProduct($productId, $body));
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
