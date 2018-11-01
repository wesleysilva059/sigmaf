<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MachineShopRepository;
use App\Entities\MachineShop;
use App\Validators\MachineShopValidator;

/**
 * Class MachineShopRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MachineShopRepositoryEloquent extends BaseRepository implements MachineShopRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MachineShop::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MachineShopValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
