<?php

namespace App\Services\Api\Audit;

use App\Traits\LogReader;
use App\Services\ApiService;

class QueryService extends ApiService
{
    use LogReader;

    /**
     * Index function.
     */
    public function index()
    {
        return $this->createResponse(trans('api.response.accepted'), [
            'data' => $this->getFileList('daily', 'query')
        ], 202);
    }

    /**
     * Show function.
     * 
     * @param $path
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
            'data' => $this->getFileContent('query-' . $date)
        ], 206);
    }
}