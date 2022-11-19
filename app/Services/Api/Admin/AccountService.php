<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\AccountResource;

class AccountService extends ApiService
{
    /**
     * Index function.
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
     * Store function.
     * 
     * @param $request
     */
    public function store($request)
    {
        $this->userInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($id)
    {
        $user = $this->userInterface->findById(intval($id));

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new AccountResource($user)
        ], 206);
    }

    /**
     * Update function.
     * 
     * @param $request
     * @param $id
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
     * Destroy function.
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $this->userInterface->deleteById($id);

        return $this->index();
    }
}