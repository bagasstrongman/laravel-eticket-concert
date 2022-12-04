<?php

namespace App\Services\Api\Audit;

use App\Services\ApiService;
use App\Http\Resources\Audit\AuthResource;

class AuthService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $auth = $this->auditInterface->all(['*'], [], [['log_name', 'auth']]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => AuthResource::collection($auth)
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $auth = $this->auditInterface->findById($id, ['*'], [], [['log_name', 'auth']]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AuthResource($auth)
        ], 206);
    }
}