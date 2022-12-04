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
        $quantity = $this->quantity . ' ticket';

        if ($this->quantity > 1) {
            $quantity = $this->quantity . ' tickets';
        }

        return [
            'user' => $this->user->username,
            'concert' => $this->concert->name,
            'transaction_code' => $this->transaction_code,
            'quantity' => $quantity,
            'total_payment' => $this->total_payment,
            'payment_date' => dateYmdToDmy($this->payment_date),
        ];
    }
}
