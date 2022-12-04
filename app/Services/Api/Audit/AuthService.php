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
        return $this->createResponse(trans('api.response.accepted'), [
            'data' => AuthResource::collection($this->auditInterface->all(['*'], [], [['log_name', 'Login'], ['log_name', 'Logout'], ['log_name', 'Register']]))
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $audit = $this->auditInterface->findById($id, ['*'], [], [['log_name', 'Login'], ['log_name', 'Logout'], ['log_name', 'Register']]);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AuthResource($audit)
        ], 206);
    }
}