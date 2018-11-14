<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OilChange.
 *
 * @package namespace App\Entities;
 */
class OilChange extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'periodOilChange',
		'oilChangeType_id',
		'vehicle_id',
		'employee_id',
		'initDate',
		'endDate',
		'nextDateOilChange',
		'currentKmHr',
		'maintenanceStatus_id',
    ];

    public function oilChangeType(){
        return $this->belongsTo(OilChangeType::class, 'oilChangeType_id');
    }

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

    public function getFormatedNextDateOilChangeAttribute()
    {
        $nextDateOilChange = explode('-', $this->attributes['nextDateOilChange']);

        if(count($nextDateOilChange) != 3)
            return "";

        $nextDateOilChange = $nextDateOilChange[2]. '/' . $nextDateOilChange[1] . '/' . $nextDateOilChange[0];
        return $nextDateOilChange;
    }

}
