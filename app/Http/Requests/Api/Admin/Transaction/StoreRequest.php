<?php

namespace App\Http\Requests\Api\Admin\Transaction;

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
            'concert_id' => ['required','numeric','min:1'],
            'user_id' => ['required','numeric','min:1'],
            'transaction_code' => ['required','string','max:255'],
            'quantity' => ['required','numeric','min:1'],
            'total_payment' => ['required','string','max:255'],
            'payment_date' => ['required','date','date_format:d-m-Y']
        ];
    }
}
