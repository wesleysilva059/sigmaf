<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Lubrification.
 *
 * @package namespace App\Entities;
 */
class Lubrification extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'periodLubrification',
		'vehicle_id',
		'employee_id',
		'initDate',
		'endDate',
		'nextDateLubrification',
		'currentKmHr',
		'maintenanceStatus_id',
        'description'
    ];


    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function maintenanceStatus(){
        return $this->belongsTo(MaintenanceStatus::class, 'maintenancesStatus_id');
    }

    public function getFormatedInitDateAttribute()
    {
        $initDate = explode('-', $this->attributes['initDate']);

        if(count($initDate) != 3)
            return "";

        $initDate = $initDate[2]. '/' . $initDate[1] . '/' . $initDate[0];
        return $initDate;
    }

    public function getFormatedNextDateLubrificationAttribute()
    {
        $nextDateLubrification = explode('-', $this->attributes['nextDateLubrification']);

        if(count($nextDateLubrification) != 3)
            return "";

        $nextDateLubrification = $nextDateLubrification[2]. '/' . $nextDateLubrification[1] . '/' . $nextDateLubrification[0];
        return $nextDateLubrification;
    }

}
