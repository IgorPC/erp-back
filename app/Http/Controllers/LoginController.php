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
                'data' => $this->authService->auth($request->input('email'), $request->input('password'))
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' => [
                    'success' => false,
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function RegenerateToken(Request $request) {
        try {
            return response()->json([
                'data' => $this->authService->regenerateToken($request->input('email'))
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'data' =>
                    [
                        'message' => $exception->getMessage(),
                        'success' => false
                    ]
            ], 400);
        }
    }
}
