<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Resource;

class ApplicationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'app_name' => $this->app_name,
            'meta_author' => $this->meta_author,
            'meta_keywords' => $this->meta_keywords,
            'meta_description' => $this->meta_description
        ];
    }
}
