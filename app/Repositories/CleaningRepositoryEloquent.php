<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CleaningRepository;
use App\Entities\Cleaning;
use App\Validators\CleaningValidator;

/**
 * Class CleaningRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CleaningRepositoryEloquent extends BaseRepository implements CleaningRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cleaning::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CleaningValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
