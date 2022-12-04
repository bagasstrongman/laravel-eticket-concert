<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiController;
use App\Services\Api\Admin\ConcertService;
use App\Http\Requests\Api\Admin\Concert\StoreRequest;
use App\Http\Requests\Api\Admin\Concert\UpdateRequest;

class ConcertController extends ApiController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['permission:concert.index'], ['only' => ['index']]);
        $this->middleware(['permission:concert.store'], ['only' => ['store']]);
        $this->middleware(['permission:concert.show'], ['only' => ['show']]);
        $this->middleware(['permission:concert.update'], ['only' => ['update']]);
        $this->middleware(['permission:concert.delete'], ['only' => ['delete']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConcertService $service)
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
    public function store(StoreRequest $request, ConcertService $service)
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
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show(ConcertService $service, $code)
    {
        try {
            return $service->show($code);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ConcertService $service, $code)
    {
        try {
            return $service->update($request->validated(), $code);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConcertService $service, $code)
    {
        try {
            return $service->destroy($code);
        } catch (\Throwable $th) {
            return $this->catchError($th);
        }
    }
}