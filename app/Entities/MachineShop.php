<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MachineShop.
 *
 * @package namespace App\Entities;
 */
class MachineShop extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name',
		'address',
        'city_id',
		'phone'
    ];

    public function city()
    {

        return $this->belongsTo(City::class);

    }

}
