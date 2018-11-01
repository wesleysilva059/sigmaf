<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\FilterChangeTypeRepository;
use App\Entities\FilterChangeType;
use App\Validators\FilterChangeTypeValidator;

/**
 * Class FilterChangeTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FilterChangeTypeRepositoryEloquent extends BaseRepository implements FilterChangeTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return FilterChangeType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FilterChangeTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
