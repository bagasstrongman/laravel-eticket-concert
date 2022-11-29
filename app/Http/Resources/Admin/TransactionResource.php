<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Resource;

class TransactionResource extends Resource
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
            'concert' => $this->event->name,
            'user' => $this->buyer->name,
            'paid_at' => dateYmdToDmy($this->paid_at),
            'book_at' => dateYmdToDmy($this->book_at)
        ];
    }
}
