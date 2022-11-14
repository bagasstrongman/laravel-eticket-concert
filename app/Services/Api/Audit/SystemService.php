<?php

namespace App\Services\Api\Audit;

use App\Traits\LogReader;
use App\Services\ApiService;

class SystemService extends ApiService
{
    use LogReader;

    /**
     * Index function.
     */
    public function index()
    {
        return $this->createResponse('Data berhasil diterima', [
            'data' => $this->getFileContent('daily')
        ], 202);
    }
}