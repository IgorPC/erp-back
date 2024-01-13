<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductSaleRepository;

class ProductSaleService
{
    private $productSaleRepository;

    public function __construct(ProductSaleRepository $productSaleRepository)
    {
        $this->productSaleRepository = $productSaleRepository;
    }

    public function addProductToSale($saleId, $product)
    {
        $product['sale_id'] = $saleId;
        return $this->productSaleRepository->create($product);
    }
}
