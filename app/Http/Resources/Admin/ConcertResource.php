<?php

namespace App\Http\Resources\Admin;

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
            'company' => $this->companion->name,
            'name' => $this->name,
            'start_at' => dateYmdToDmy($this->start_at),
            'end_at' => dateYmdToDmy($this->end_at)
        ];
    }
}
