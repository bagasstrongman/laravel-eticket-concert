<?php

namespace App\Http\Requests\Api\Transaction;

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
            'concert' => ['required','numeric'],
            'user' => ['required','numeric'],
            'paid_at' => ['required','string','date_format:d-m-Y'],
            'book_at' => ['required','string','date_format:d-m-Y']
        ];
    }
}
