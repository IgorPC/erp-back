<?php

namespace App\Http\Repositories;

use App\Models\ProductStatus;

class ProductStatusRepository
{
    private $productStatus;

    public function __construct(ProductStatus $productStatus)
    {
        $this->productStatus = $productStatus;
    }

    public function findByStatusDescription($description)
    {
        return $this->productStatus->where('description', $description)->first();
    }

    public function findAll()
    {
        return $this->productStatus->all();
    }
}
