<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CostCenter.
 *
 * @package namespace App\Entities;
 */
class CostCenter extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','department_id'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function vehicle(){
        return $this->hasMany(Vehicle::class);
    }

}
