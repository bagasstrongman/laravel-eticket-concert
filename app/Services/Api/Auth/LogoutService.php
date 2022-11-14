<?php

namespace App\Services\Api\Auth;

use App\Services\ApiService;
use App\Http\Resources\Auth\LogoutResource;

class LogoutService extends ApiService
{
    /**
     * Store function.
     * 
     * @param $request
     */
    public function store()
    {
        $user = auth('sanctum')->user();

        request()->user()->currentAccessToken()->delete();

        return $this->createResponse('Logout berhasil', [
            'data' => new LogoutResource($user)
        ], 202);
    }
}