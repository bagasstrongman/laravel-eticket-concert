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
        $transactions = $this->transactionInterface->all(['*'], ['event','buyer']);

        if (count($transactions) > 0) {
            return $this->createResponse('Data berhasil diterima', [
                'data' => TransactionResource::collection($transactions)
            ], 202);
        }

        return $this->createResponse('Data berhasil diterima', [
            'data' => 'Tidak ada data yang tersedia'
        ], 202);
    }

    /**
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $transaction = $this->transactionInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $transaction = $this->transactionInterface->findById(intval($id), ['*'], ['event','buyer']);

        return $this->createResponse('Data berhasil diterima', [
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
        $transaction = $this->transactionInterface->update(intval($id), $request);

        if (empty($request)) {
            return $this->createResponse('Data berhasil diubah', [
                'data' => 'Tidak ada data yang diubah'
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