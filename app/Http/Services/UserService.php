<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create($userData)
    {
        $user = $this->userRepository->findUserByEmail($userData['email']);

        if ($user) {
            return [
                'success' => false,
                'data' => 'Email has already been registered'
            ];
        }

        return [
            'success' => true,
            'data' => $this->userRepository->create($userData)
        ];
    }
}
