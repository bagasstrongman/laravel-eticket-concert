<?php

namespace App\Http\Requests\Api\Profile\Account;

use App\Rules\LanguageRule;
use App\Http\Requests\ApiRequest;

class StoreRequest extends ApiRequest
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
            'username' => ['nullable','string','max:255','unique:users,username'],
            'email' => ['nullable','string','max:255','unique:users,email','email:dns'],
            'language' => ['nullable','string','max:255',new LanguageRule]
        ];
    }
}
