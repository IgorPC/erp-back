<?php

namespace App\Http\Controllers;

use App\Http\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function Create(Request $request)
    {
        try {
            $body = [
                "first_name" => $request->input('first_name'),
                "last_name" => $request->input('last_name'),
                "email" => $request->input('email'),
                "phone_number" => $request->input('phone_number'),
                "created_by" => $request->input('created_by')
            ];

            return response()->json($this->clientService->createClient($body));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function Update($clientId, Request $request)
    {
        try {
            $body = [
                "first_name" => $request->input('first_name'),
                "last_name" => $request->input('last_name'),
                "email" => $request->input('email'),
                "phone_number" => $request->input('phone_number'),
                "status_id" => $request->input('status_id')
            ];

            return response()->json($this->clientService->updateClient($clientId, $body));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function Get($clientId)
    {
        try {
            return response()->json($this->clientService->getClient($clientId));
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => [
                    'message' => $exception->getMessage()
                ]
            ], 400);
        }
    }

    public function List(Request $request)
    {
        try {
            $body = [
                "page" => $request->get('page'),
                "rows" => $request->get('rows'),
                "filterBy" => $request->get("filterBy"),
                "search" => $request->get("search")
            ];

            return response()->json($this->clientService->listWithPagination(
                $body['rows'],
                $body['page'],
                $body['filterBy'],
                $body['search']
            ));
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
