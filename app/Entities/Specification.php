<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Specification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'vehicle_id',
		'engine',
		'engineNumber',
		'tireWeight',
		'frontTires',
		'backTires',
		'protector',
		'innerTires',
		'frontCanvasPad',
		'backCanvasPad',
		'frontTambor',
		'backTambor',
		'frontBumper',
		'backBumper',
		'vehicleBodywork',
		'spring',
		'currentKmHr',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

}