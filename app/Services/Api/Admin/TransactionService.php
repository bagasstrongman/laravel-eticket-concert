<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\TransactionResource;

class TransactionService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $transactions = $this->transactionInterface->all(['*'], ['concert','user']);

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
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $this->transactionInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($code)
    {
        $transaction = $this->transactionInterface->all(['*'], ['concert','user'], [['transaction_code', $code]])->first();

        if (empty($transaction)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.transaction.not_found')
            ], 404);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new TransactionResource($transaction)
        ], 206);
    }

    /**
     * Update function.
     * 
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        $this->transactionInterface->update(intval($id), $request);

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        return $this->index();
    }

    /**
     * Destroy function.
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $this->transactionInterface->deleteById($id);

        return $this->index();
    }
}