<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Insurance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'numInsurancePolicy',
		'insurer',
		'insuranceBroker',
		'value',
		'initEffectiveDate',
		'endEffectiveDate',
		'vehicle_id',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

}