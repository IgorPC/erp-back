<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductStatusService;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    private $productStatusService;

    public function __construct(ProductStatusService $productStatusService)
    {
        $this->productStatusService = $productStatusService;
    }

    public function List()
    {
        try {
            return response()->json($this->productStatusService->getAll());
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
