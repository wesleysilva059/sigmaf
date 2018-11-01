<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OtherService;

/**
 * Class OtherServiceTransformer.
 *
 * @package namespace App\Transformers;
 */
class OtherServiceTransformer extends TransformerAbstract
{
    /**
     * Transform the OtherService entity.
     *
     * @param \App\Entities\OtherService $model
     *
     * @return array
     */
    public function transform(OtherService $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
