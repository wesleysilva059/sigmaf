<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class VehicleType.
 *
 * @package namespace App\Entities;
 */
class VehicleType extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','vehicleSize'];

    public function vehicle(){
        return $this->hasMany(vehicle::class);
    }

}
