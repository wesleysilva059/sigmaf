<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Employee.
 *
 * @package namespace App\Entities;
 */
class Employee extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
		'registration',
		'occupation_id',
        'status'
    ];

    public function occupation(){
        return $this->belongsTo(Occupation::class);
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

    public function getFormatedStatusAttribute()
    {
        $status = $this->attributes['status'];

        switch ($status) {
            case "1":
                $status = "Ativo";
                break;

            case "2":
                $status = "Inativo";
                break;
        }
        return $status;
    }

}
