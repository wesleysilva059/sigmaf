<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\VehicleType;

/**
 * Class VehicleTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class VehicleTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the VehicleType entity.
     *
     * @param \App\Entities\VehicleType $model
     *
     * @return array
     */
    public function transform(VehicleType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
