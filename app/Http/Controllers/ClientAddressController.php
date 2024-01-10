<?php

namespace App\Http\Controllers;

use App\Http\Services\ClientAddressService;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
{
    private $clientAddressService;

    public function __construct(ClientAddressService $clientAddressService)
    {
        $this->clientAddressService = $clientAddressService;
    }

    public function Set(Request $request)
    {
        try {
            $body = [
                'client_id' => $request->input('client_id'),
                'street' => $request->input('street'),
                'number' => $request->input('number'),
                'neighborhood' => $request->input('neighborhood'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'zip_code' => $request->input('zip_code'),
            ];

            return response()->json($this->clientAddressService->setAddress($body));
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
