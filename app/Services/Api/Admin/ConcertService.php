<?php

namespace App\Services\Api\Admin;

use App\Services\ApiService;
use App\Http\Resources\Admin\ConcertResource;

class ConcertService extends ApiService
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     * 
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        if (!empty($request['image'])) {
            $request['image'] = $this->saveSingleFile('image', $request['image']);
        }

        $this->concertInterface->create($request);

        return $this->index();
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  string  $code
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     * 
     * @param  array  $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function update($request, $code)
    {
        $concert = $this->concertInterface->all(['*'], [], [['code', $code]])->first();

        if (empty($concert)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.concert.not_found')
            ], 404);
        }

        if (empty($request)) {
            return $this->createResponse(trans('api.response.updated'), [
                'data' => trans('api.response.no_data_changed')
            ], 202);
        }

        if (!empty($request['image'])) {
            $request['image'] = $this->updateSingleFile('image', $request['image'], $concert->image);
        }

        $concert->update($request);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        $concert = $this->concertInterface->all(['*'], [], [['code', $code]])->first();
        
        if (empty($concert)) {
            return $this->createResponse(trans('api.response.not_found'), [
                'error' => trans('api.concert.not_found')
            ], 404);
        }

        $concert->delete();

        return $this->index();
    }
}