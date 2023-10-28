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

    public function findUserById($userId)
    {
        $user = User::where('id', $userId)->first();

        if (! $user) {
            return false;
        }

        $user->userAddress->first();

        if ($user->profile_picture) {
            $host = request()->getSchemeAndHttpHost();
            $user->profile_picture = $host . "/storage" .  $user->profile_picture;
        }

        return $user;
    }
}
