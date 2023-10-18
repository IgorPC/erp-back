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
        return $this->userRepository->create($userData);
    }
}
