<?php

namespace App\Services\Api\Main;

use App\Services\ApiService;
use App\Http\Resources\Main\TransactionResource;

class TransactionService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $transactions = $this->transactionInterface->all(['*'], ['event','buyer'], [['user', auth('sanctum')->user()->id]]);

        if (count($transactions) > 0) {
            return $this->createResponse(trans('api.response.accepted'), [
                'data' => TransactionResource::collection($transactions)
            ], 202);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => trans('api.response.no_data')
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $transaction = $this->transactionInterface->findById(intval($id), ['*'], ['event','buyer'], [['user', auth('sanctum')->user()->id]]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new TransactionResource($transaction)
        ], 206);
    }
}