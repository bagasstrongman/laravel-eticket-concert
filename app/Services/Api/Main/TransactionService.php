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
        $transactions = $this->transactionInterface->all(['*'], ['concert','user'], [['user_id', auth('sanctum')->user()->id]]);

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
    public function show($code)
    {
        $transaction = $this->transactionInterface->all(['*'], ['concert','user'], [['transaction_code', $code], ['user_id', auth('sanctum')->user()->id]])->first();

        if (empty($transaction)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.transaction.not_found')
            ], 404);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new TransactionResource($transaction)
        ], 206);
    }
}