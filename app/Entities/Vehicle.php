<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Vehicle.
 *
 * @package namespace App\Entities;
 */
class Vehicle extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'vehiclePlate',
		'vehicleColor',
		'yearManufactory',
		'yearModel',
		'purchaseDate',
		'renavam',
		'chassis',
        'typeFuel',
		'typeControl',
		'status',
		'currentKmHr',
		'vehicleModel_id',
		'costCenter_id',
		'vehicleType_id',
		'comments',
    ];

    public function vehicleModel(){
        return $this->belongsTo(VehicleModel::class, 'vehicleModel_id');
    }

    public function costCenter()
    {
        return $this->belongsTo(CostCenter::class,'costCenter_id');
    }


    public function vehicleType(){
        return $this->belongsTo(VehicleType::class,'vehicleType_id');
    }

    public function insurance(){
        return $this->hasOne(Insurance::class);
    }

    public function specification(){
        return $this->hasOne(Specification::class);
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

    public function cleaning(){
        return $this->hasMany(Cleaning::class);
    }

    public function getFormatedDateAttribute()
    {
        $date = explode('-', $this->attributes['date']);

        if(count($date) != 3)
            return "";

        $date = $date[2]. '/' . $date[1] . '/' . $date[0];
        return $date;
    }

    public function getFormatedStatusAttribute()
    {
        $status = $this->attributes['status'];

        switch ($status) {
            case "0":
                $status = "Ativo";
                break;

            case "1":
                $status = "Inativo";
                break;

            case "2":
                $status = "Em Manutenção";
                break;

            case "3":
                $status = "Doação";
                break;

            case "4":
                $status = "Leilão";
                break;
        }
        return $status;
    }

    public function getFormatedTypeFuelAttribute()
    {
        $typeFuel = $this->attributes['typeFuel'];

        switch ($typeFuel) {
            case "1":
                $typeFuel = "Gasolina";
                break;

            case "2":
                $typeFuel = "Alcool";
                break;

            case "3":
                $typeFuel = "Bi-Combustível";
                break;

            case "4":
                $typeFuel = "Diesel";
                break;

            case "5":
                $typeFuel = "Diesel S10";
                break;
        }
        return $typeFuel;
    }

     public function getFormatedTypeControlAttribute()
    {
        $typeControl = $this->attributes['typeControl'];

        switch ($typeControl) {
            case "0":
                $typeControl = "Km";
                break;

            case "1":
                $typeControl = "Hr";
                break;
        }
        return $typeControl;
    }

}
