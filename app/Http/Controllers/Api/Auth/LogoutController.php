<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiController;
use App\Services\Api\Auth\LogoutService;

class LogoutController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LogoutService $service)
    {
        try {
            return $service->store();
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}
