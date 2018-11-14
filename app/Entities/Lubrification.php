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
		'lubrificationType_id',
		'vehicle_id',
		'employee_id',
		'initDate',
		'endDate',
		'nextDateLubrification',
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

}
