<?php

namespace App\Http\Services;

use App\Http\Repositories\SaleRepository;

class SaleService
{
    private $saleRepository;

    public function __construct(SaleRepository $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }
}
