<?php

namespace App\Services\Api\Auth;

use App\Services\ApiService;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

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
            return $this->createResponse('Authentikasi Gagal', [
                'error' => 'Akun tidak ditemukan, silahkan register terlebih dahulu'
            ], 401);
        }

        if (!$user || !Hash::check($request['password'], $user->password)) {
            return $this->createResponse('Authentikasi Gagal', [
                'error' => 'Password salah, silahkan coba lagi'
            ], 401);
        }
        
        $token = $user->createToken(fake()->name);

        return $this->createResponse('Authentikasi berhasil', [
            'data' => new UserResource($user),
            'token' => $token->plainTextToken
        ], 202);
    }
}