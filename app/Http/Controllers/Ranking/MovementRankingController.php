<?php

namespace App\Http\Controllers\Ranking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ranking\MovementRankingRequest;
use App\Http\Resources\Ranking\MovementRankingResource;
use App\Services\Ranking\MovementRankingService;

class MovementRankingController extends Controller
{
    private $service;

    public function __construct(MovementRankingService $service)
    {
        $this->service = $service;
    }

    public function index(MovementRankingRequest $request)
    {
        try {
            $this->service->get($request->get('id'));
            return response()
                ->json(MovementRankingResource::collection($this->service->get($request->get('id')))
                    ->toArray($request), 200);
        } catch (\Throwable $e) {
            return response()
                ->json('There was a problem. Please try again.', $e->getCode());
        }
    }
}
