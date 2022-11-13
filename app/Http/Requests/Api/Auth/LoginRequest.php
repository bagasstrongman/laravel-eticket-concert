<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required','string','max:255'],
            'password' => ['required','string','min:8','max:255']
        ];
    }
}
