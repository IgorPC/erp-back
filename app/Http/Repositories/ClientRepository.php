<?php

namespace App\Http\Repositories;

use App\Http\Services\PaginationService;
use App\Models\Client;

class ClientRepository
{
    private $client;
    private $paginationService;

    public function __construct(Client $client, PaginationService $paginationService)
    {
        $this->client = $client;
        $this->paginationService = $paginationService;
    }

    public function findByEmail($email)
    {
        return $this->client->where('email', $email)->first();
    }

    public function findById($id, $with = [])
    {
        return $this->client->where('id', $id)->with($with)->first();
    }

    public function create($client)
    {
        return $this->client->create($client);
    }

    public function update($clientId, $data)
    {
        return $this->client->where('id', $clientId)->update($data);
    }

    public function listWithPagination($page, $rows, $filter, $search)
    {
        return $this->paginationService->paginate(
            $this->client,
            $rows,
            $page,
            $filter,
            $search,
            ['clientStatus', 'createdBy', 'clientAddress']
        );
    }
}
