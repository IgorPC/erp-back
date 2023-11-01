<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductStatusRepository;

class ProductStatusService
{
    private $productStatusRepository;

    public function __construct(ProductStatusRepository $productStatusRepository)
    {
        $this->productStatusRepository = $productStatusRepository;
    }

    public function findByProductStatusDescription($productStatusDescription)
    {
        return $this->productStatusRepository->findByStatusDescription($productStatusDescription);
    }
}
