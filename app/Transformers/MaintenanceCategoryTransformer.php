<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MaintenanceCategory;

/**
 * Class MaintenanceCategoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class MaintenanceCategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the MaintenanceCategory entity.
     *
     * @param \App\Entities\MaintenanceCategory $model
     *
     * @return array
     */
    public function transform(MaintenanceCategory $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
