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
        $quantity = $this->quantity . ' ticket';

        if ($this->quantity > 1) {
            $quantity = $this->quantity . ' tickets';
        }

        return [
            'user' => $this->user->username,
            'transaction_code' => $this->transaction_code,
            'quantity' => $quantity,
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
