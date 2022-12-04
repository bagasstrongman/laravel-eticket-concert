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
            'concert_id' => ['nullable','numeric','min:1'],
            'user_id' => ['nullable','numeric','min:1'],
            'transaction_code' => ['nullable','string','max:255'],
            'quantity' => ['nullable','numeric','min:1'],
            'total_payment' => ['nullable','string','max:255'],
            'payment_date' => ['nullable','date','date_format:d-m-Y']
        ];
    }
}
