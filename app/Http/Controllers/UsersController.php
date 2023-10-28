<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function GetUserInfo($userId)
    {
        try {
            return response()->json($this->userService->getUserInfo($userId));
        } catch (\Exception $exception) {
            return response()->json([
                [
                    'success' => false,
                    'data' => $exception->getMessage()
                ]
            ]);
        }
    }

    public function SetUserInfo($userId, Request $request)
    {
        try {
            $body = [
                'first_name' => $request->input('firstName'),
                'last_name' => $request->input('lastName')
            ];

            return response()->json($this->userService->setUserInfo($userId, $body));
        } catch (\Exception $exception) {
            return response()->json([
                [
                    'success' => false,
                    'data' => $exception->getMessage()
                ]
            ]);
        }
    }

    public function SetProfilePicture($userId, Request $request)
    {
        try {
            $body = [
                'file' => $request->input('file'),
                'mimeType' => $request->input('mimeType')
            ];

            return response()->json($this->userService->setProfilePicture($userId, $body));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception->getMessage()
            ]);
        }
    }
}
