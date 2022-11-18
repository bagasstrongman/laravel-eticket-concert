<?php

namespace App\Http\Controllers\Api\profile;

use App\Http\Controllers\ApiController;
use App\Services\Api\Profile\AccountService;
use App\Http\Requests\Api\Profile\Account\UpdateRequest;

class AccountController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccountService $service)
    {
        try {
            return $service->index();
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AccountService $service, $id)
    {
        try {
            return $service->update($request->validated(), $id);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}
