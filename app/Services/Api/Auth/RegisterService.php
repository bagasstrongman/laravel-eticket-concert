<?php

namespace App\Services\Api\Auth;

use App\Services\ApiService;
use App\Http\Resources\Auth\RegisterResource;

class RegisterService extends ApiService
{
    /**
     * Store a newly created resource in storage.
     * 
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $user = $this->userInterface->create($request);

        activity('auth')->withProperties($user)->log($user->username . ' berhasil di daftarkan');

        return $this->createResponse(trans('api.register.success', ['username' => $user->username]), [
            'data' => new RegisterResource($user)
        ], 202);
    }
}