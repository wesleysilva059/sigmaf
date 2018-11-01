<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OilChange;

/**
 * Class OilChangeTransformer.
 *
 * @package namespace App\Transformers;
 */
class OilChangeTransformer extends TransformerAbstract
{
    /**
     * Transform the OilChange entity.
     *
     * @param \App\Entities\OilChange $model
     *
     * @return array
     */
    public function transform(OilChange $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
