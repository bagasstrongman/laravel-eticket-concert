<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\ApplicationResource;

class ApplicationService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $application = $this->userInterface->findById(1);

        return $this->createResponse('Data berhasil diterima', [
            'data' => new ApplicationResource($application)
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
        $this->userInterface->update(1, $request);

        if (empty($request)) {
            return $this->createResponse('Data berhasil diubah', [
                'data' => 'Tidak ada data yang diubah'
            ], 202);
        }

        return $this->index();
    }
}