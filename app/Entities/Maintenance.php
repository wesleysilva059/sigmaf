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

}
