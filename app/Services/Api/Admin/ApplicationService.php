<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\ApplicationResource;

class ApplicationService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $application = $this->applicationInterface->findById(1);

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new ApplicationResource($application)
        ], 202);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $this->applicationInterface->update(1, $request);

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        return $this->index();
    }
}