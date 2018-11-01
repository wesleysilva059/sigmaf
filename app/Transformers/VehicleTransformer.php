<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Vehicle;

/**
 * Class VehicleTransformer.
 *
 * @package namespace App\Transformers;
 */
class VehicleTransformer extends TransformerAbstract
{
    /**
     * Transform the Vehicle entity.
     *
     * @param \App\Entities\Vehicle $model
     *
     * @return array
     */
    public function transform(Vehicle $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
