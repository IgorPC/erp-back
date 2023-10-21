<?php

namespace App\Http\Controllers;

use App\Http\Services\UserStreetAddress;
use Illuminate\Http\Request;

class UserStreetController extends Controller
{

    private $userStreetService;

    public function __construct(UserStreetAddress $userStreetAddress)
    {
        $this->userStreetService = $userStreetAddress;
    }

    public function GetAddress($userId)
    {
        try {
            return response()->json($this->userStreetService->getAddress($userId));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function AddAddress(Request $request)
    {
        try {
            $body = [
                "user_id" => $request->input('user_id'),
                "street" => $request->input('street'),
                "number" => $request->input('number'),
                "neighborhood" => $request->input('neighborhood'),
                "city" => $request->input('city'),
                "country" => $request->input('country'),
                "zip_code" => $request->input('zip_code')
            ];

            return response()->json($this->userStreetService->setAddress($body));
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
