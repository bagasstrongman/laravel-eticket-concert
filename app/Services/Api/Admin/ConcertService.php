<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\ConcertResource;

class ConcertService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $concerts = $this->concertInterface->all(['*'], ['company']);

        if (count($concerts) > 0) {
            return $this->createResponse(trans('api.response.accepted'), [
                'data' => ConcertResource::collection($concerts)
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
        $this->concertInterface->create($request);

        return $this->index();
    }

    /**
     * Show function.
     * 
     * @param $path
     */
    public function show($code)
    {
        $concert = $this->concertInterface->all(['*'], ['company'], [['code', $code]])->first();

        if (empty($concert)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.concert.not_found')
            ], 404);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => new ConcertResource($concert)
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
        $this->concertInterface->update(intval($id), $request);

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
        $this->concertInterface->deleteById($id);

        return $this->index();
    }
}