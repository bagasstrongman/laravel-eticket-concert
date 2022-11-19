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
            return $this->createResponse(trans('api.response.accepted'), [
                'data' => BuyResource::collection($transactions)
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
        $concert = $this->concertInterface->all(['*'], [], [['id', $request['concert']]])->first();

        if ($concert == null) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.concert.not_found')
            ], 404);
        }

        $date = now();

        for ($i=0; $i < intval($request['quantity']); $i++) {
            $this->transactionInterface->create([
                'concert' => $concert->id,
                'user' => auth('sanctum')->user()->id,
                'paid_at' => $date,
                'book_at' => $date,
                'created_at' => $date
            ]);
        }

        return $this->index($date);
    }
}