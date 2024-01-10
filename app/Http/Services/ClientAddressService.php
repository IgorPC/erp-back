<?php

namespace App\Http\Services;

use App\Http\Repositories\ClientAddressRepository;

class ClientAddressService
{
    private $clientAddressRepository;
    private $clientService;

    public function __construct(
        ClientAddressRepository $clientAddressRepository,
        ClientService $clientService
    ){
        $this->clientAddressRepository = $clientAddressRepository;
        $this->clientService = $clientService;
    }

    public function setAddress($body)
    {
        $client = $this->clientService->findById($body['client_id']);

        if (! $client) {
            return [
                'success' => false,
                'data'=> 'Client not found'
            ];
        }

        $clientHasAddress = $this->clientAddressRepository->findByClientId($client->id);

        if ($clientHasAddress) {
            $updatedAddress = [
                'street' => $body['street'],
                'number' => $body['number'],
                'neighborhood' => $body['neighborhood'],
                'city' => $body['city'],
                'country' => $body['country'],
                'zip_code' => $body['zip_code']
            ];

            $action = $this->clientAddressRepository->update($client->id, $updatedAddress);

            if (! $action) {
                return [
                    'success' => false,
                    'data'=> 'Internal Server Error'
                ];
            }

            return [
                'success' => true,
                'data'=> 'Client Address Successfully updated'
            ];
        }

        $newClientAddress = [
            'client_id' => $client->id,
            'street' => $body['street'],
            'number' => $body['number'],
            'neighborhood' => $body['neighborhood'],
            'city' => $body['city'],
            'country' => $body['country'],
            'zip_code' => $body['zip_code'],
        ];

        $clientAddress = $this->clientAddressRepository->create($newClientAddress);

        if (! $clientAddress) {
            return [
                'success' => false,
                'data'=> 'Internal Server error'
            ];
        }

        return [
            'success' => true,
            'data'=> 'Client Address Successfully created',
            'product_id' => $clientAddress->id
        ];
    }
}
