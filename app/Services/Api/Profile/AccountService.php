<?php

namespace App\Services\Api\Profile;

use App\Services\ApiService;
use App\Http\Resources\Profile\AccountResource;

class AccountService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = $this->userInterface->findById(auth('sanctum')->user()->id);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AccountResource($account)
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
        $this->userInterface->update(auth('sanctum')->user()->id, $request);

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        return $this->index();
    }
}