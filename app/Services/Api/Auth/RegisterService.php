<?php

namespace App\Services\Api\Auth;

use App\Services\ApiService;
use App\Http\Resources\UserResource;

class RegisterService extends ApiService
{
    /**
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $user = $this->userInterface->create($request);

        return $this->createResponse('Akun berhasil di daftarkan', [
            'data' => new UserResource($user)
        ], 202);
    }
}