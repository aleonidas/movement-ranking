<?php

namespace Tests\Feature\Ranking;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovementRankingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    protected function route($id)
    {
        return $this->getJson(route('ranking.movement.index', ['id' => $id]));
    }

    public function test_movement_id_invalid()
    {
        $response = $this->route(999);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'id' => [
                        'The selected id is invalid.'
                    ]
                ]
            ]);
    }

    public function test_fail_with_string_parameter()
    {
        $response = $this->route('notInteger');

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'id' => [
                        'The id must be an integer.'
                    ]
                ]
            ]);
    }

    /**
     * // não concluido
     */
    public function list_of_users_with_three_different_ranking_positions()
    {
        $response = $this->route(1);

        $data = [
            'movement' => 'Deadlift',
            'users' => [
                [
                    'position' => 1,
                    'name' => 'Jose',
                    'value' => 190,
                    'data' => '2021-01-06T00:00:00+00:00',
                ],
                [
                    'position' => 2,
                    'name' => 'Joao',
                    'value' => 180,
                    'data' => '2021-01-02T00:00:00+00:00',
                ],
                [
                    'position' => 3,
                    'name' => 'Paulo',
                    'value' => 170,
                    'data' => '2021-01-01T00:00:00+00:00',
                ]
            ]
        ];

        $response->assertStatus(200)
            ->assertJson($data);
    }
}
