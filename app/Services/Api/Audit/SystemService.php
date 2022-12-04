<?php

namespace App\Services\Api\Audit;

use App\Traits\LogReader;
use App\Services\ApiService;

class SystemService extends ApiService
{
    use LogReader;

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->createResponse(trans('api.response.accepted'), [
            'data' => $this->getFileList('daily')
        ], 202);
    }

    /**
     * Display the specified resource.
     * 
     * @param  string  $date
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
        $formated_date = date_create($date);

        if (!$formated_date) {
            return $this->createResponse('Server Error', [
                'error' => trans('validation.date_format', ['attribute' => $date, 'format' => 'Y-m-d'])
            ], 500);
        }

        return $this->createResponse(trans('api.response.accepted'), [
            'data' => $this->getFileContent('laravel-' . $date)
        ], 206);
    }
}