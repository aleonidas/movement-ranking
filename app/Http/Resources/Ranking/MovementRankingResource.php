<?php

namespace App\Http\Resources\Ranking;

use Illuminate\Http\Resources\Json\JsonResource;

class MovementRankingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'movement' => $this->resource['movement'],
            'users' => UserMovementRankingResource::collection($this->resource['users']),
        ];
    }
}
