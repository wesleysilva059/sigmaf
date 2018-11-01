<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VehicleTypeRepository;
use App\Entities\VehicleType;
use App\Validators\VehicleTypeValidator;

/**
 * Class VehicleTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VehicleTypeRepositoryEloquent extends BaseRepository implements VehicleTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VehicleType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VehicleTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
