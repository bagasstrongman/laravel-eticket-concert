<?php

namespace App\Http\Controllers\Api\Audit;

use App\Http\Controllers\ApiController;
use App\Services\Api\Audit\SystemService;

class SystemController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SystemService $service)
    {
        try {
            return $service->index();
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}