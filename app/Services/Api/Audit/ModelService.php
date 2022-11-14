<?php

namespace App\Services\Api\Audit;

use App\Services\ApiService;
use App\Http\Resources\Audit\ModelResource;

class ModelService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        return $this->createResponse('Data berhasil diterima', [
            'data' => ModelResource::collection($this->auditInterface->all(['*'], [], [['log_name', '!=', 'login'], ['log_name', '!=', 'logout']]))
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $audit = $this->auditInterface->findById($id, ['*'], [], [['log_name', '!=', 'login'], ['log_name', '!=', 'logout']]);

        return $this->createResponse('Data berhasil diterima', [
            'data' => new ModelResource($audit)
        ], 206);
    }
}