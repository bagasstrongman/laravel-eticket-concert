<?php

namespace App\Services\Api\Auth;

use App\Services\ApiService;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\LoginResource;

class LoginService extends ApiService
{
    /**
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        try {
            $user = $this->userInterface->findByCustomId([['username', $request['username']]]);
        } catch (\Throwable $th) {
            return $this->createResponse(trans('api.login.error'), [
                'error' => trans('api.login.not_found')
            ], 401);
        }

        if (!Hash::check($request['password'], $user->password)) {
            return $this->createResponse(trans('api.login.error'), [
                'error' => trans('api.login.invalid_password')
            ], 401);
        }
        
        $token = $user->createToken(fake()->userName);

        activity('Login')->withProperties($user)->log($user->username . ' berhasil login');

        return $this->createResponse(trans('api.login.success'), [
            'data' => new LoginResource($user),
            'token' => $token->plainTextToken
        ], 202);
    }
}