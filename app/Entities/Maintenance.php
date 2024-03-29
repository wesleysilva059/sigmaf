<?php

namespace App\Entities;

use App\Entities\Vehicle;
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
        'currentKmHr'
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

    public function getFormatedExpectedDateEndAttribute()
    {
        $expectedDateEnd = explode('-', $this->attributes['expectedDateEnd']);

        if(count($expectedDateEnd) != 3)
            return "";

        $expectedDateEnd = $expectedDateEnd[2]. '/' . $expectedDateEnd[1] . '/' . $expectedDateEnd[0];
        return $expectedDateEnd;
    }

    
    public function search(Array $data, $totalPage)
    {
        $vehicle = Vehicle::where('vehiclePlate', $data['vehiclePlate'])->get();

        $historics = $this->where(function ($query) use ($data, $vehicle) {
            
            if (isset($data['vehiclePlate']))
                $query->where('vehicle_id', $vehicle[0]->id);

            if (isset($data['date_init']) && isset($data['date_end']))
                $query->whereBetween('initDateMaintenance',[$data['date_init'],$data['date_end']]);

        })

        ->paginate($totalPage);
        //->toSql();dd($historics);

        return $historics;
    }

    public function searchByCar(Array $data, $totalPage)
    {
        $vehicle = Vehicle::where('vehiclePlate', $data['vehiclePlate'])->get();

        $historics = $this->where(function ($query) use ($data, $vehicle) {
            
            if (isset($data['vehiclePlate']))
                $query->where('vehicle_id', $vehicle[0]->id);

        })

        ->paginate($totalPage);
        //->toSql();dd($historics);

        return $historics;
    }

}
