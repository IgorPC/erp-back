<?php

namespace App\Http\Repositories;

use App\Models\ClientStatus;

class ClientStatusRepository
{
    private $clientStatus;

    public function __construct(ClientStatus $clientStatus)
    {
        $this->clientStatus = $clientStatus;
    }

    public function findByStatusDescription($description)
    {
        return $this->clientStatus->where('description', $description)->first();
    }

    public function findById($id)
    {
        return $this->clientStatus->where('id', $id)->first();
    }

    public function findAll()
    {
        return $this->clientStatus->all();
    }
}
