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
}
