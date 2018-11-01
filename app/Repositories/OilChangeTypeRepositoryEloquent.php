<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OilChangeTypeRepository;
use App\Entities\OilChangeType;
use App\Validators\OilChangeTypeValidator;

/**
 * Class OilChangeTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OilChangeTypeRepositoryEloquent extends BaseRepository implements OilChangeTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OilChangeType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OilChangeTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
