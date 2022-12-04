<?php

namespace App\Http\Requests\Api\Company\Concert;

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
            'company_id' => ['required','numeric','min:1'],
            'name' => ['required','string','max:255','unique:concerts,name'],
            'code' => ['required','string','max:255','unique:concerts,code'],
            'start_at' => ['required','date','date_format:d-m-Y','after:'.now()->subDay()->format('d-m-Y')],
            'end_at' => ['required','date','date_format:d-m-Y','after:'.now()->format('d-m-Y')]
        ];
    }
}
