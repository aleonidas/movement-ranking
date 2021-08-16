<?php

namespace App\Http\Requests\Ranking;

use Illuminate\Foundation\Http\FormRequest;

class MovementRankingRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'int',
                'required',
                'exists:movement,id',
            ],
        ];
    }
}
