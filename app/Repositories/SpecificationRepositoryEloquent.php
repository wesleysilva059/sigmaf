<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SpecificationRepository;
use App\Entities\Specification;
use App\Validators\SpecificationValidator;

/**
 * Class SpecificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SpecificationRepositoryEloquent extends BaseRepository implements SpecificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Specification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SpecificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
