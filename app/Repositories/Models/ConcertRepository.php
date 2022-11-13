<?php

namespace App\Repositories\Models;

use App\Models\Concert;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\EloquentRepository;
use App\Contracts\Models\ConcertInterface;

class ConcertRepository extends EloquentRepository implements ConcertInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Base respository constructor
     * 
     * @param Model $model
     */
    public function __construct(Concert $model)
    {
        $this->model = $model;
    }
}