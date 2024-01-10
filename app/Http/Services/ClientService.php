<?php

namespace App\Http\Services;

use App\Http\Repositories\ClientRepository;

class ClientService
{
    private $clientRepository;
    private $userService;
    private $clientStatusService;

    public function __construct(
        ClientRepository $clientRepository,
        UserService $userService,
        ClientStatusService $clientStatusService
    ){
        $this->clientRepository = $clientRepository;
        $this->userService = $userService;
        $this->clientStatusService = $clientStatusService;
    }

    public function createClient($body)
    {
        $user = $this->userService->findUserById($body['created_by']);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }

        $activeStatus = $this->clientStatusService->findByDescription('Active');

        if (! $activeStatus) {
            return [
                'success' => false,
                'data'=> 'No active status for a client was found in the database'
            ];
        }

        $emailAlreadyExists = $this->clientRepository->findByEmail($body['email']);

        if ($emailAlreadyExists) {
            return [
                'success' => false,
                'data'=> 'Email already belongs to an existent client'
            ];
        }

        $newClient = [
            "first_name" => $body['first_name'],
            "last_name" => $body['last_name'],
            "email" => $body['email'],
            "phone_number" => $body['phone_number'],
            "created_by" => $user->id,
            "status_id" => $activeStatus->id
        ];

        $client = $this->clientRepository->create($newClient);

        if (! $client) {
            return [
                'success' => false,
                'data'=> 'Internal Server error'
            ];
        }

        return [
            'success' => true,
            'data'=> 'Client Successfully created',
            'product_id' => $client->id
        ];
    }

    public function updateClient($clientId, $body)
    {
        $client = $this->clientRepository->findById($clientId);

        if (! $client) {
            return [
                'success' => false,
                'data'=> 'Client not found'
            ];
        }

        $status = $this->clientStatusService->findById($body['status_id']);

        if (! $status) {
            return [
                'success' => false,
                'data'=> 'Status not found'
            ];
        }

        $emailAlreadyExists = $this->clientRepository->findByEmail($body['email']);

        if ($emailAlreadyExists && $emailAlreadyExists->id !== $client->id) {
            return [
                'success' => false,
                'data'=> 'Email already belongs to an existent client'
            ];
        }

        $action = $this->clientRepository->update($clientId, $body);

        if (! $action) {
            return [
                'success' => false,
                'data'=> 'Internal Server Error'
            ];
        }

        return [
            'success' => true,
            'data'=> 'Client Successfully updated'
        ];
    }

    public function getClient($clientId)
    {
        $client = $this->clientRepository->findById($clientId, ['clientStatus', 'clientAddress']);

        if (! $client) {
            return [
                'success' => false,
                'data'=> 'Client not found'
            ];
        }

        return [
            'success' => true,
            'data'=> $client
        ];
    }

    public function listWithPagination($rows, $page, $filter, $search)
    {
        return $this->clientRepository->listWithPagination($page, $rows, $filter, $search);
    }

    public function findById($clientId)
    {
        return $this->clientRepository->findById($clientId);
    }
}
