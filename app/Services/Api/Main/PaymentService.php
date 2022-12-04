<?php

namespace App\Services\Api\Main;

use App\Services\ApiService;
use App\Http\Resources\Main\PaymentResource;

class PaymentService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $transactions = $this->transactionInterface->findById($id, ['*'], ['concert','user']);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new PaymentResource($transactions)
        ], 202);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $concert = $this->concertInterface->all(['*'], [], [['code', $request['concert_code']]])->first();

        if (empty($concert)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.payment.not_found')
            ], 404);
        }

        $user = auth('sanctum')->user();
        $quantity = $request['quantity'];

        $transaction = $this->transactionInterface->create([
            'concert_id' => $concert->id,
            'user_id' => $user->id,
            'transaction_code' => $concert->code . '-' . uniqid() . '-' . date('dmY') . '-' . $user->id,
            'quantity' => $quantity,
            'total_payment' => $quantity * $concert->price,
            'payment_date' => dateDmyToYmd(now())
        ]);

        return $this->index($transaction->id);
    }
}