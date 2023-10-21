<?php

namespace App\Http\Services;

use App\Http\Repositories\UserStreetRepository;

class UserStreetAddress
{
    private $userStreetRepository;

    public function __construct(UserStreetRepository $userStreetRepository)
    {
        $this->userStreetRepository = $userStreetRepository;
    }

    public function getAddress($userId)
    {
        $userAddress = $this->userStreetRepository->findByUserId($userId);

        if (! $userAddress) {
            return [
                'success' => true,
                'data' => null,
                'message' => "User does not have an address"
            ];
        }

        return [
            'success' => true,
            'data' => $userAddress,
            'message' => null
        ];
    }

    public function setAddress($addressData)
    {
        return [
            'success' => true,
            'data' => $this->userStreetRepository->setAddress($addressData)
        ];
    }
}
