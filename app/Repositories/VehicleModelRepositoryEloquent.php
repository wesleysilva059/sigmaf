<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VehicleModelRepository;
use App\Entities\VehicleModel;
use App\Validators\VehicleModelValidator;

/**
 * Class VehicleModelRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VehicleModelRepositoryEloquent extends BaseRepository implements VehicleModelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VehicleModel::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return VehicleModelValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
