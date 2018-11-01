<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MaintenanceStatusRepository;
use App\Entities\MaintenanceStatus;
use App\Validators\MaintenanceStatusValidator;

/**
 * Class MaintenanceStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MaintenanceStatusRepositoryEloquent extends BaseRepository implements MaintenanceStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MaintenanceStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MaintenanceStatusValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
