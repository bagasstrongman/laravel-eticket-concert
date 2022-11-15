<?php

namespace App\Services\Api\Main;

use App\Services\ApiService;
use App\Http\Resources\Main\CompanyResource;

class CompanyService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $companies = $this->companyInterface->all();

        if (count($companies) > 0) {
            return $this->createResponse('Data berhasil diterima', [
                'data' => CompanyResource::collection($companies)
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
        $this->companyInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $company = $this->companyInterface->findById(intval($id));

        return $this->createResponse('Data berhasil diterima', [
            'data' => new CompanyResource($company)
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
        $this->companyInterface->update(intval($id), $request);

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
        $this->companyInterface->deleteById($id);

        return $this->index();
    }
}