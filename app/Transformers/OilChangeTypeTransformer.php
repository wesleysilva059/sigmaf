<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OilChangeType;

/**
 * Class OilChangeTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class OilChangeTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the OilChangeType entity.
     *
     * @param \App\Entities\OilChangeType $model
     *
     * @return array
     */
    public function transform(OilChangeType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
