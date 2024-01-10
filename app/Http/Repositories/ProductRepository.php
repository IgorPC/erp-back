<?php

namespace App\Http\Repositories;

use App\Http\Services\PaginationService;
use App\Models\Product;

class ProductRepository
{
    private $product;
    private $paginationService;

    public function __construct(Product $product,PaginationService $paginationService)
    {
        $this->product = $product;
        $this->paginationService = $paginationService;
    }

    public function findById($productId)
    {
        return $this->product->where('id', $productId)->with('productStatus')->first();
    }

    public function listWithPagination($page, $rows, $filter, $search)
    {
        return $this->paginationService->paginate(
            $this->product,
            $rows,
            $page,
            $filter,
            $search,
            ['productStatus', 'createdBy']
        );
    }

    public function findByCode($code)
    {
        return $this->product->where('code', $code)->first();
    }
    public function create($productData)
    {
        return $this->product->create($productData);
    }

    public function update($productId, $productData)
    {
        return $this->product->where('id', $productId)->update($productData);
    }
}
