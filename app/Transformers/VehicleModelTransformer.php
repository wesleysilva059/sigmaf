<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\VehicleModel;

/**
 * Class VehicleModelTransformer.
 *
 * @package namespace App\Transformers;
 */
class VehicleModelTransformer extends TransformerAbstract
{
    /**
     * Transform the VehicleModel entity.
     *
     * @param \App\Entities\VehicleModel $model
     *
     * @return array
     */
    public function transform(VehicleModel $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
