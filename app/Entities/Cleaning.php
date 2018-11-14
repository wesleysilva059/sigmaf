<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cleaning.
 *
 * @package namespace App\Entities;
 */
class Cleaning extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'date',
		'currentKmHr',
		'vehicle_id',
		'employee_id',
		'description',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function getFormateddateAttribute()
    {
        $date = explode('-', $this->attributes['date']);

        if(count($date) != 3)
            return "";

        $date = $date[2]. '/' . $date[1] . '/' . $date[0];
        return $date;
    }

}
