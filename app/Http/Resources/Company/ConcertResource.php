<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\Resource;

class ConcertResource extends Resource
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
            'name' => $this->name,
            'company' => $this->company->name,
            'code' => $this->code,
            'price' => $this->price,
            'start_at' => dateYmdToDmy($this->start_at),
            'end_at' => dateYmdToDmy($this->end_at)
        ];
    }
}
