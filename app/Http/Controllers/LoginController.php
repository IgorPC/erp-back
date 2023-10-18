<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function Login(Request $request) {
        try {
            return response()->json([
                'success' => true,
                'data' => $this->authService->auth($request->input('email'), $request->input('password'))
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }
}
