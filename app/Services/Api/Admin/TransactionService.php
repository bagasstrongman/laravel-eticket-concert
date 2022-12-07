<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\TransactionResource;

class TransactionService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     * 
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $this->transactionInterface->create($request);

        return $this->index();
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $code
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     * 
     * @param  array  $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function update($request, $code)
    {
        $transaction = $this->transactionInterface->all(['*'], [], [['transaction_code', $code]])->first();

        if (empty($transaction)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.transaction.not_found')
            ], 404);
        }

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        $transaction->update($request);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $transaction = $this->transactionInterface->all(['*'], [], [['transaction_code', $code]])->first();
        
        if (empty($transaction)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.transaction.not_found')
            ], 404);
        }

        $transaction->delete();

        return $this->index();
    }
}