<?php

namespace App\Http\Requests\Api\Admin\Concert;

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
        $date = now()->format('d-m-Y');
        
        return [
            'company_id' => ['nullable','numeric','min:1','exists:companies,id'],
            'name' => ['nullable','string','max:255','unique:concerts,name'],
            'code' => ['nullable','string','max:255','unique:concerts,code'],
            'price' => ['nullable','string','max:255'],
            'start_at' => ['nullable','date','date_format:d-m-Y','after_or_equal:'.$date],
            'end_at' => ['nullable','date','date_format:d-m-Y','after:'.$date],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,svg','max:4092','dimensions:min_width=100,min_height=100']
        ];
    }
}
