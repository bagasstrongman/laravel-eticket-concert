<?php

namespace App\Services\Api\Profile;

use App\Services\ApiService;
use App\Http\Resources\Profile\AccountResource;

class AccountService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $account = $this->userInterface->findById(auth('sanctum')->user()->id);

        return $this->createResponse('Data berhasil diterima', [
            'data' => new AccountResource($account)
        ], 202);
    }

    /**
     * Update function.
     * 
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        $this->userInterface->update(auth('sanctum')->user()->id, $request);

        if (empty($request)) {
            return $this->createResponse('Data berhasil diubah', [
                'data' => 'Tidak ada data yang diubah'
            ], 202);
        }

        return $this->index();
    }
}