<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LubrificationTypeRepository;
use App\Entities\LubrificationType;
use App\Validators\LubrificationTypeValidator;

/**
 * Class LubrificationTypeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LubrificationTypeRepositoryEloquent extends BaseRepository implements LubrificationTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LubrificationType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LubrificationTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
