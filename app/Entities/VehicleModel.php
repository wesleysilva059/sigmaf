<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class VehicleModel.
 *
 * @package namespace App\Entities;
 */
class VehicleModel extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'make_id'];

    public function make(){
        return $this->belongsTo(make::class);
    }
    
    public function vehicle(){
        return $this->hasMany(vehicle::class);
    }

}

