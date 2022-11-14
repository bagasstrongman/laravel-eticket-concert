<?php

namespace App\Http\Requests\Api\Concert;

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
            'company' => ['required','numeric'],
            'name' => ['required','string','max:255','unique:concerts,name'],
            'start_at' => ['required','string','date_format:d-m-Y'],
            'end_at' => ['required','string','date_format:d-m-Y']
        ];
    }
}
