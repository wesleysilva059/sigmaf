<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MaintenanceRepository;
use App\Entities\Maintenance;
use App\Validators\MaintenanceValidator;

/**
 * Class MaintenanceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MaintenanceRepositoryEloquent extends BaseRepository implements MaintenanceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Maintenance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MaintenanceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
