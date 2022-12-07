<?php

namespace App\Http\Requests\Api\Admin\Concert;

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
        $date = now()->format('d-m-Y');
        
        return [
            'company_id' => ['required','numeric','min:1','exists:companies,id'],
            'name' => ['required','string','max:255','unique:concerts,name'],
            'code' => ['required','string','max:255','unique:concerts,code'],
            'price' => ['required','string','max:255'],
            'start_at' => ['required','date','date_format:d-m-Y','after_or_equal:'.$date],
            'end_at' => ['required','date','date_format:d-m-Y','after:'.$date],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,svg','max:4092','dimensions:min_width=100,min_height=100']
        ];
    }
}
