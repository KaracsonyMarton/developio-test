<?php

namespace App\Http\Controllers\Spa;

use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Interfaces\TicketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketingController extends Controller
{
    /**
     * @param TicketRepositoryInterface $repository
     */
    public function __construct(private TicketRepositoryInterface $repository)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $tickets = $this->repository->findAll();
        return response()->json(TicketResource::collection($tickets));
    }
}
