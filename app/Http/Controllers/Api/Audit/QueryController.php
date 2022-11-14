<?php

namespace App\Http\Controllers\Api\Audit;

use App\Http\Controllers\ApiController;
use App\Services\Api\Audit\QueryService;

class QueryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(QueryService $service)
    {
        try {
            return $service->index();
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}