<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ($this->method() == 'PUT')
            ? [
                'name' => 'required',
                'email' => "required|email|unique:users,email,{$this->user->id}",
                'password' => 'required|min:8'
            ]
            : [
                'name' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:users,email',
                'password' => 'sometimes|required|min:8'
            ];
    }
}
