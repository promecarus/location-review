<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ($this->method() == 'PUT')
            ? [
                'location_id' => 'required|exists:locations,id',
                'user_id' => 'required|exists:users,id',
                'rating' => 'required|integer|min:1|max:5',
                'message' => 'string'
            ]
            : [
                'location_id' => 'sometimes|required|exists:locations,id',
                'user_id' => 'sometimes|required|exists:users,id',
                'rating' => 'sometimes|required|integer|min:1|max:5',
                'message' => 'sometimes|string'
            ];



        [
            'location_id' => 'required|exists:locations,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'string'
        ];
    }
}
