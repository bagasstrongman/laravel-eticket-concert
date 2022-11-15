<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\BuyService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Buy\StoreRequest;

class BuyController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, BuyService $service)
    {
        try {
            return $service->store($request->validated());
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}