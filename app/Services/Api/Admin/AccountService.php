<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\AccountResource;

class AccountService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $users = $this->userInterface->all();

        if (count($users) > 0) {
            return $this->createResponse('Data berhasil diterima', [
                'data' => AccountResource::collection($users)
            ], 202);
        }

        return $this->createResponse('Data berhasil diterima', [
            'data' => 'Tidak ada data yang tersedia'
        ], 202);
    }

    /**
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $this->userInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $user = $this->userInterface->findById(intval($id));

        return $this->createResponse('Data berhasil diterima', [
            'data' => new AccountResource($user)
        ], 206);
    }

    /**
     * Update function.
     * 
     * @param $request
     * @param $id
     */
    public function update($request, $id)
    {
        $this->userInterface->update(intval($id), $request);

        if (empty($request)) {
            return $this->createResponse('Data berhasil diubah', [
                'data' => 'Tidak ada data yang diubah'
            ], 202);
        }

        return $this->index();
    }

    /**
     * Destroy function.
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $this->userInterface->deleteById($id);

        return $this->index();
    }
}