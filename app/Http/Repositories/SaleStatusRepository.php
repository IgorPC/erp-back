<?php

namespace App\Http\Repositories;

use App\Models\Sale;
use App\Models\SaleStatus;

class SaleStatusRepository
{
    private $saleStatus;

    public function __construct(SaleStatus $saleStatus)
    {
        $this->saleStatus = $saleStatus;
    }

    public function findByDescription($description)
    {
        return $this->saleStatus->where('description', $description)->first();
    }
}
