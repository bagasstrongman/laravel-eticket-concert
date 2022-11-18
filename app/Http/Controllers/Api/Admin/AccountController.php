<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiController;
use App\Services\Api\Admin\AccountService;
use App\Http\Requests\Api\Admin\Account\StoreRequest;
use App\Http\Requests\Api\Admin\Account\UpdateRequest;

class AccountController extends ApiController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:admin']);
        $this->middleware(['role:superadmin']);
        $this->middleware(['permission:account.index'], ['only' => ['index']]);
        $this->middleware(['permission:account.store'], ['only' => ['store']]);
        $this->middleware(['permission:account.show'], ['only' => ['show']]);
        $this->middleware(['permission:account.update'], ['only' => ['update']]);
        $this->middleware(['permission:account.delete'], ['only' => ['delete']]);
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, AccountService $service)
    {
        try {
            return $service->store($request->validated());
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
    public function show(AccountService $service, $id)
    {
        try {
            return $service->show($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountService $service, $id)
    {
        try {
            return $service->destroy($id);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}
