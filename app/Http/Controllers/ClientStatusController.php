<?php

namespace App\Http\Controllers;

use App\Http\Services\ClientStatusService;
use Illuminate\Http\Request;

class ClientStatusController extends Controller
{
    private $clientStatusService;

    public function __construct(ClientStatusService $clientStatusService)
    {
        $this->clientStatusService = $clientStatusService;
    }

    public function List()
    {
        try {
            return response()->json($this->clientStatusService->getAll());
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
