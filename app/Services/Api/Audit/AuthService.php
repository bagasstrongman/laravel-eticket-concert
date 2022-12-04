<?php

namespace App\Services\Api\Audit;

use App\Services\ApiService;
use App\Http\Resources\Audit\AuthResource;

class AuthService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = $this->auditInterface->all(['*'], [], [['log_name', 'auth']]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => AuthResource::collection($auth)
        ], 202);
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = $this->auditInterface->findById($id, ['*'], [], [['log_name', 'auth']]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AuthResource($auth)
        ], 206);
    }
}