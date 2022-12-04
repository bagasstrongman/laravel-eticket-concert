<?php

namespace App\Http\Resources\Main;

use Illuminate\Support\Str;
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
            'user' => $this->user->username,
            'transaction_code' => $this->transaction_code,
            'quantity' => $this->quantity . ' ' . Str::plural('ticket', $this->quantity),
            'total_payment' => $this->total_payment,
            'book_at' => dateYmdToDmy($this->book_at),
            'concert' => [
                'code' => $this->concert->code,
                'price' => $this->concert->price,
                'company' => $this->concert->company->name,
                'start_at' => dateYmdToDmy($this->concert->start_at),
                'end_at' => dateYmdToDmy($this->concert->end_at)
            ]
        ];
    }
}
