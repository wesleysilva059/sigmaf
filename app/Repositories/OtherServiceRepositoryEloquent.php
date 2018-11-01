<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OtherServiceRepository;
use App\Entities\OtherService;
use App\Validators\OtherServiceValidator;

/**
 * Class OtherServiceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OtherServiceRepositoryEloquent extends BaseRepository implements OtherServiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OtherService::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OtherServiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
