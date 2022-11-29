<?php

namespace App\Http\Resources\Main;

use App\Http\Resources\Resource;

class PaymentResource extends Resource
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
            'user' => $this->buyer->username,
            'paid_at' => dateYmdToDmy($this->paid_at),
            'book_at' => dateYmdToDmy($this->book_at),
            'concert' => [
                'name' => $this->event->name,
                'start_at' => $this->event->start_at,
                'end_at' => $this->event->end_at
            ]
        ];
    }
}
