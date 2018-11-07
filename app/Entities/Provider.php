<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Provider.
 *
 * @package namespace App\Entities;
 */
class Provider extends Model implements Transformable
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
		'phone',
		'email'
    ];

    public function city()
    {

        return $this->belongsTo(City::class);

    }

}
