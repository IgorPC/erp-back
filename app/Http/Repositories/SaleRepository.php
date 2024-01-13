<?php

namespace App\Http\Repositories;

use App\Models\Sale;

class SaleRepository
{
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function createSale($sale)
    {
        return $this->sale->create($sale);
    }
}
