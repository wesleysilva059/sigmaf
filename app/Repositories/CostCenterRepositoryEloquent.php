<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CostCenterRepository;
use App\Entities\CostCenter;
use App\Validators\CostCenterValidator;

/**
 * Class CostCenterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CostCenterRepositoryEloquent extends BaseRepository implements CostCenterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CostCenter::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CostCenterValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
