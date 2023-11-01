<?php

namespace App\Http\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function findById($productId)
    {
        return $this->product->where('id', $productId)->first();
    }

    public function listWithPagination($page, $rows)
    {
        return $this->product->with(['productStatus', 'createdBy'])->paginate($rows, ['*'], 'page', $page);
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
