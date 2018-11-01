<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OilChangeRepository;
use App\Entities\OilChange;
use App\Validators\OilChangeValidator;

/**
 * Class OilChangeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OilChangeRepositoryEloquent extends BaseRepository implements OilChangeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OilChange::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OilChangeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
