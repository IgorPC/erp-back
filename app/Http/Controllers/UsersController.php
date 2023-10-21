<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

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
}
