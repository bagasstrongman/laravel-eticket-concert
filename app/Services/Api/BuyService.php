<?php

namespace App\Services\Api;

use App\Services\ApiService;
use App\Http\Resources\BuyResource;

class BuyService extends ApiService
{
    /**
     * Index function.
     */
    public function index($date)
    {
        $transactions = $this->transactionInterface->all(['*'], ['event','buyer'], [['created_at', $date], ['user', auth('sanctum')->user()->id]]);

        if (count($transactions) > 0) {
            return $this->createResponse('Data berhasil diterima', [
                'data' => BuyResource::collection($transactions)
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
        $concert = $this->concertInterface->all(['*'], [], [['id', $request['concert']]])->first();

        if ($concert == null) {
            return $this->createResponse('Data tidak ditemukan', [
                'error' => 'data konser tidak ditemukan pada database'
            ], 404);
        }

        $date = now();

        for ($i=0; $i < intval($request['quantity']); $i++) {
            $this->transactionInterface->create([
                'concert' => $concert->id,
                'user' => auth('sanctum')->user()->id,
                'paid_at' => $date->format('Y-m-d'),
                'book_at' => $date->format('Y-m-d'),
                'created_at' => $date
            ]);
        }

        return $this->index($date);
    }
}