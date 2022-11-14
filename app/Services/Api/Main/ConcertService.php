<?php

namespace App\Services\Api\Main;

use App\Services\ApiService;
use App\Http\Resources\Main\ConcertResource;

class ConcertService extends ApiService
{
    /**
     * Index function.
     */
    public function index()
    {
        $concerts = $this->concertInterface->all(['*'], ['companion']);

        if (count($concerts) > 0) {
            return $this->createResponse('Data berhasil diterima', [
                'data' => ConcertResource::collection($concerts)
            ], 202);
        }

        return $this->createResponse('Data berhasil diterima', [
            'data' => 'Tidak ada data yang tersedia'
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
    public function show($id)
    {
        $concert = $this->concertInterface->findById(intval($id), ['*'], ['companion']);

        return $this->createResponse('Data berhasil diterima', [
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
            return $this->createResponse('Data berhasil diubah', [
                'data' => 'Tidak ada data yang diubah'
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