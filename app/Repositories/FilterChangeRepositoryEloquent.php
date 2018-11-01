<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FilterChangeRepository;
use App\Entities\FilterChange;
use App\Validators\FilterChangeValidator;

/**
 * Class FilterChangeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FilterChangeRepositoryEloquent extends BaseRepository implements FilterChangeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FilterChange::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FilterChangeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
