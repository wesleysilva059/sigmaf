<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MaintenanceStatus.
 *
 * @package namespace App\Entities;
 */
class MaintenanceStatus extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function maintenance(){
        return $this->hasMany(Maintenance::class);
    }

    public function filterChange(){
        return $this->hasMany(FilterChange::class);
    }

    public function oilChange(){
        return $this->hasMany(OilChange::class);
    }

    public function lubrification(){
        return $this->hasMany(Lubrification::class);
    }

}
