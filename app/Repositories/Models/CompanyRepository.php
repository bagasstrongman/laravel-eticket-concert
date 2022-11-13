<?php

namespace App\Repositories\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\EloquentRepository;
use App\Contracts\Models\CompanyInterface;

class CompanyRepository extends EloquentRepository implements CompanyInterface
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
    public function __construct(Company $model)
    {
        $this->model = $model;
    }
}