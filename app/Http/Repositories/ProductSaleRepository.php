<?php

namespace App\Http\Repositories;

use App\Models\ProductSale;

class ProductSaleRepository
{
    private $productSale;

    public function __construct(ProductSale $productSale)
    {
        $this->productSale = $productSale;
    }
}
