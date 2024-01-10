<?php

namespace App\Http\Services;

use App\Http\Repositories\ClientStatusRepository;

class ClientStatusService
{
    private $clientStatusRepository;

    public function __construct(
        ClientStatusRepository $clientStatusRepository,
    ){
        $this->clientStatusRepository = $clientStatusRepository;
    }

    public function findByDescription($description)
    {
        return $this->clientStatusRepository->findByStatusDescription($description);
    }

    public function findById($id)
    {
        return $this->clientStatusRepository->findById($id);
    }

    public function getAll()
    {
        return $this->clientStatusRepository->findAll();
    }
}
