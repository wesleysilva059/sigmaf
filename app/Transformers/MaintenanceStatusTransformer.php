<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MaintenanceStatus;

/**
 * Class MaintenanceStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class MaintenanceStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the MaintenanceStatus entity.
     *
     * @param \App\Entities\MaintenanceStatus $model
     *
     * @return array
     */
    public function transform(MaintenanceStatus $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
