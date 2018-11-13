<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Maintenance.
 *
 * @package namespace App\Entities;
 */
class Maintenance extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'cod',
		'vehicle_id',
		'purchaseItem',
		'localService',
		'priority',
		'story',
		'plannedMaintenance',
		'maintenanceCategory_id',
		'maintenanceStatus_id',
		'machineShop_id',
		'provider_id',
		'costCenter_id',
		'department_id',
		'initDateMaintenance',
		'endDateMaintenance',
		'expectedDateEnd',
		'serviceDescRealized',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class,'costCenter_id');
    }

    public function maintenanceCategory()
    {
        return $this->belongsTo(MaintenanceCategory::class,'maintenanceCategory_id');
    }

    public function maintenanceStatus()
    {
        return $this->belongsTo(MaintenanceStatus::class,'maintenanceStatus_id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class,'provider_id');
    }

    public function machineShop()
    {
        return $this->belongsTo(MachineShop::class,'machineShop_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function getFormatedInitDateMaintenanceAttribute()
    {
        $initDateMaintenance = explode('-', $this->attributes['initDateMaintenance']);

        if(count($initDateMaintenance) != 3)
            return "";

        $initDateMaintenance = $initDateMaintenance[2]. '/' . $initDateMaintenance[1] . '/' . $initDateMaintenance[0];
        return $initDateMaintenance;
    }

}
