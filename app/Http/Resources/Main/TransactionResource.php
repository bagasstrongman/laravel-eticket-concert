<?php

namespace App\Http\Resources\Main;

use Illuminate\Support\Str;
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
            'user' => $this->user->username,
            'concert' => $this->concert->name,
            'transaction_code' => $this->transaction_code,
            'quantity' => $this->quantity . ' ' . Str::plural('ticket', $this->quantity),
            'total_payment' => $this->total_payment,
            'payment_date' => dateYmdToDmy($this->payment_date),
        ];
    }
}
