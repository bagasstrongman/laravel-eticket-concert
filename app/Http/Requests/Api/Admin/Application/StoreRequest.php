<?php

namespace App\Http\Requests\Api\Admin\Application;

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
            'app_name' => ['nullable','string','max:255'],
            'app_icon' => ['nullable','image','mimes:jpg,jpeg,png,svg','max:4092','dimensions:min_width=100,min_height=100'],
            'meta_author' => ['nullable','string','max:255'],
            'meta_keywords' => ['nullable','string','max:255'],
            'meta_description' => ['nullable','string','max:255']
        ];
    }
}
