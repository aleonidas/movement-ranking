<?php

namespace App\Services\Ranking;

use App\Models\Movement;
use Illuminate\Support\Collection;

class MovementRankingService
{
    /**
     * @param int $id
     * @return Collection
     */
    public function get(int $id): Collection
    {
        $query = $this->getQuery($id);
        $users = $this->setPosition($query);

        $movement = Movement::findOrFail($id);
        return collect([
            collect([
                'movement' => $movement->name,
                'users' => $users,
            ])
        ]);
    }

    /**
     * @param int $id
     * @return Collection
     */
    protected function getQuery(int $id): Collection
    {
        return \DB::table('movement')
            ->select([
                'movement.name AS movement',
                'user.name AS user',
                'personal_record.value',
                'personal_record.date',
            ])
            ->join('personal_record', 'personal_record.movement_id', '=', 'movement.id')
            ->leftJoin('personal_record AS personal_record_clone', function($join) {
                $join->on('personal_record.user_id', '=', 'personal_record_clone.user_id')
                    ->on('personal_record.movement_id', '=', 'personal_record_clone.movement_id')
                    ->on('personal_record.value', '<', 'personal_record_clone.value');
            })
            ->join('user', 'user.id', '=', 'personal_record.user_id')
            ->where('movement.id', '=', $id)
            ->whereNull('personal_record_clone.value')
            ->orderByDesc('personal_record.value')
            ->orderByDesc('personal_record.date')
            ->get();
    }

    /**
     * @param Collection $query
     * @return Collection
     */
    protected function setPosition(Collection $query): Collection
    {
        $position = 0;
        return $query->map(function ($item, $key) use ($query, &$position) {
            $position++;

            if ($key > 0) {
                $previousKey = --$key;
                $previousQuery = $query[$previousKey];

                if (isset($previousQuery) && $previousQuery->value === $item->value) {
                    $position--;
                }
            }

            $item->position = $position;
            return $item;
        });
    }
}
