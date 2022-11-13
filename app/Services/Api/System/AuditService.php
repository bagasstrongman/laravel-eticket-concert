<?php

namespace App\Services\Api\System;

use App\Services\ApiService;
use App\Http\Resources\AuditResource;

class AuditService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        return $this->createResponse('Data berhasil diterima', [
            'data' => AuditResource::collection($this->auditInterface->all())
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $audit = $this->auditInterface->findById($id);

        return $this->createResponse('Data berhasil diterima', [
            'data' => new AuditResource($audit)
        ], 206);
    }
}