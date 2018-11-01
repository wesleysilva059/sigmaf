<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AlertRepository;
use App\Entities\Alert;
use App\Validators\AlertValidator;

/**
 * Class AlertRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AlertRepositoryEloquent extends BaseRepository implements AlertRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Alert::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AlertValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
