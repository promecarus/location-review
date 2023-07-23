<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ($this->method() == 'PUT')
            ? [
                'latitude' => 'required|numeric|min:-90|max:90',
                'longitude' => 'required|numeric|min:-180|max:180'
            ]
            : [
                'latitude' => 'sometimes|required|numeric|min:-90|max:90',
                'longitude' => 'sometimes|required|numeric|min:-180|max:180'
            ];
    }
}
