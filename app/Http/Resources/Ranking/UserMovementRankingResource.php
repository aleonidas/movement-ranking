<?php

namespace App\Http\Resources\Ranking;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMovementRankingResource extends JsonResource
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
            'position' => $this->resource->position,
            'name' => $this->resource->user,
            'value' => $this->resource->value,
            'data' => Carbon::make($this->resource->date)->toIso8601String(),
        ];
    }
}
