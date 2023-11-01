<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class UserService
{
    private $userRepository;
    private $fileStorageService;

    public function __construct(UserRepository $userRepository, FileStorageService $fileStorageService)
    {
        $this->userRepository = $userRepository;
        $this->fileStorageService = $fileStorageService;
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

    public function findUserById($userId)
    {
        return $this->userRepository->findUserById($userId);
    }

    public function getUserInfo($userId)
    {
        $user = $this->findUserById($userId);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }

        return [
            'success' => true,
            'data'=> $user
        ];
    }

    public function setUserInfo($userId, $data)
    {
        $user = $this->findUserById($userId);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }

        $action = $user->update($data);

        if ($action) {
            return [
                'success' => true,
                'data'=> 'User successfully updated'
            ];
        }

        return [
            'success' => false,
            'data'=> 'User was not updated'
        ];
    }

    public function setProfilePicture($userId, $body)
    {
        $user = $this->userRepository->findUserById($userId);

        if (! $user) {
            return [
                'success' => false,
                'data'=> 'User not found'
            ];
        }

        if ($user->profile_picture) {
            $this->fileStorageService->removeFile($user->profile_picture);
        }

        $path = $this->fileStorageService->saveFile(
            $body['file'],
            $body['mimeType'],
            "/profile_picture",
            $userId
        );

        $action = $user->update([
            'profile_picture' => $path
        ]);

        if ($action) {
            return [
                'success' => true,
                'data'=> 'Profile Picture successfully updated'
            ];
        }

        return [
            'success' => false,
            'data'=> 'Profile Picture was not updated'
        ];
    }
}
