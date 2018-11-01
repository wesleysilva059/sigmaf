<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\CostCenter;

/**
 * Class CostCenterTransformer.
 *
 * @package namespace App\Transformers;
 */
class CostCenterTransformer extends TransformerAbstract
{
    /**
     * Transform the CostCenter entity.
     *
     * @param \App\Entities\CostCenter $model
     *
     * @return array
     */
    public function transform(CostCenter $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
