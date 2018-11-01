<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Maintenance;

/**
 * Class MaintenanceTransformer.
 *
 * @package namespace App\Transformers;
 */
class MaintenanceTransformer extends TransformerAbstract
{
    /**
     * Transform the Maintenance entity.
     *
     * @param \App\Entities\Maintenance $model
     *
     * @return array
     */
    public function transform(Maintenance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
