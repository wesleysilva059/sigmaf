<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InsuranceRepository;
use App\Entities\Insurance;
use App\Validators\InsuranceValidator;

/**
 * Class InsuranceRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InsuranceRepositoryEloquent extends BaseRepository implements InsuranceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Insurance::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InsuranceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
