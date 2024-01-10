<?php

namespace App\Http\Repositories;

use App\Models\ClientAddress;

class ClientAddressRepository
{
    private $clientAddress;

    public function __construct(ClientAddress $clientAddress)
    {
        $this->clientAddress = $clientAddress;
    }

    public function create($clientAddress)
    {
        return $this->clientAddress->create($clientAddress);
    }

    public function update($clientId, $clientAddress)
    {
        return $this->clientAddress->where('client_id', $clientId)->update($clientAddress);
    }

    public function findByClientId($clientId)
    {
        return $this->clientAddress->where('client_id', $clientId)->first();
    }
}
