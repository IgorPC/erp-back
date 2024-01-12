<?php

namespace App\Http\Services;

use App\Http\Repositories\SaleStatusRepository;

class SaleStatusService
{
    private $saleStatusRepository;

    public function __construct(SaleStatusRepository $saleStatusRepository)
    {
        $this->saleStatusRepository = $saleStatusRepository;
    }
}
