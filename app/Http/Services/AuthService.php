<?php

namespace App\Http\Services;

use App\Http\Jwt\User;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function auth($email, $password)
    {
        $userData = $this->validateCredentials($email, $password);

        if (! $userData) {
           return [
               'success' => false,
               'message' => 'The provided credentials do not match our records.',
               'data' => null
           ];
        }

        return [
            'success' => true,
            'message' => 'User successfully authenticated',
            'data' => $userData
        ];
    }

    public function validateCredentials($email, $password)
    {
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        $validUser = Auth::attempt($credentials);

        if (! $validUser) {
            return false;
        }

        $user = User::where('email', $email)->first();

        return [
            'token' => JWTAuth::fromUser($user, ['exp' => now()->addMinutes(20)->timestamp]),
            'user' => $user
        ];
    }

    private function generateTokenByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return JWTAuth::fromUser($user, ['exp' => now()->addMinutes(20)->timestamp]);
    }
}
