<?php

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($userData)
    {
        return User::create([
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'password' => $userData['password'],
        ]);
    }

    public function findUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
