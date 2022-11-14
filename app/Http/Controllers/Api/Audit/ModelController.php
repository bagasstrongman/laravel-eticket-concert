<?php

namespace App\Http\Controllers\Api\Audit;

use App\Http\Controllers\ApiController;
use App\Services\Api\Audit\ModelService;

class ModelController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ModelService $service)
    {
        try {
            return $service->index();
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelService $service, $id)
    {
        try {
            return $service->show($id);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}
