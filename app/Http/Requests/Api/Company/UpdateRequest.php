<?php

namespace App\Http\Requests\Api\Company;

use App\Http\Requests\ApiRequest;

class UpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['nullable','string','max:255','unique:companies,name'],
            'phone' => ['nullable','string','max:255','unique:companies,phone'],
            'email' => ['nullable','string','max:255','unique:companies,email']
        ];
    }
}
