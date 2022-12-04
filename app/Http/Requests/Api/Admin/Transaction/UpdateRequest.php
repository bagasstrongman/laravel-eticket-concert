<?php

namespace App\Http\Requests\Api\Admin\Transaction;

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
            'concert_id' => ['nullable','numeric'],
            'user_id' => ['nullable','numeric'],
            'paid_at' => ['nullable','string','date_format:d-m-Y'],
            'book_at' => ['nullable','string','date_format:d-m-Y']
        ];
    }
}
