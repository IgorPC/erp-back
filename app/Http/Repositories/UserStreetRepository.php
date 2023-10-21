<?php

namespace App\Http\Repositories;

use App\Models\UserStreet;

class UserStreetRepository
{
    private $userStreet;

    public function __construct(UserStreet $userStreet)
    {
        $this->userStreet = $userStreet;
    }

    public function setAddress($addressData)
    {
        $userAddress = $this->findByUserId($addressData['user_id']);

        if ($userAddress && $userAddress->update($addressData)) {
            return $this->findByUserId($addressData['user_id']);
        }

        return $this->userStreet->create($addressData);
    }

    public function findByUserId($userId)
    {
        return $this->userStreet->where('user_id', $userId)->first();
    }
}
