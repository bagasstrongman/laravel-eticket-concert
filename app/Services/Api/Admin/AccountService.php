<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\AccountResource;

class AccountService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userInterface->all();

        if (count($users) > 0) {
            return $this->createResponse(trans('api.response.accepted'), [
                'data' => AccountResource::collection($users)
            ], 202);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => trans('api.response.no_data')
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
        $this->userInterface->create($request);

        return $this->index();
    }

    /**
     * Display the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userInterface->findById(intval($id));

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AccountResource($user)
        ], 206);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  array  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $this->userInterface->update(intval($id), $request);

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userInterface->deleteById($id);

        return $this->index();
    }
}