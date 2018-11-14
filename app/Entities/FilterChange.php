<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class FilterChange.
 *
 * @package namespace App\Entities;
 */
class FilterChange extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'periodFilterChange',
		'filterChangeType_id',
		'vehicle_id',
		'employee_id',
		'initDate',
		'endDate',
		'nextDateFilterChange',
		'currentKmHr',
		'maintenanceStatus_id',
    ];

    public function filterChangeType(){
        return $this->belongsTo(FilterChangeType::class, 'filterChangeType_id');
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

    public function getFormatedNextDateFilterChangeAttribute()
    {
        $nextDateFilterChange = explode('-', $this->attributes['nextDateFilterChange']);

        if(count($nextDateFilterChange) != 3)
            return "";

        $nextDateFilterChange = $nextDateFilterChange[2]. '/' . $nextDateFilterChange[1] . '/' . $nextDateFilterChange[0];
        return $nextDateFilterChange;
    }

}
