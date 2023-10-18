<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth($email, $password)
    {
       if (! $this->validateCredentials($email, $password)) {
           return [
               'success' => false,
               'message' => 'The provided credentials do not match our records.',
               'data' => null
           ];
       }

       $user = $this->userRepository->findUserByEmail($email);

       return [
            'success' => true,
            'message' => 'User successfully authenticated',
            'data' => $user
       ];
    }

    public function validateCredentials($email, $password)
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        return Auth::attempt($credentials);
    }
}
