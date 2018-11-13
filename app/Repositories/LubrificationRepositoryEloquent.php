<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LubrificationRepository;
use App\Entities\Lubrification;
use App\Validators\LubrificationValidator;

/**
 * Class LubrificationRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LubrificationRepositoryEloquent extends BaseRepository implements LubrificationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lubrification::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LubrificationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
