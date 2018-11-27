<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Insurance;

/**
 * Class InsuranceTransformer.
 *
 * @package namespace App\Transformers;
 */
class InsuranceTransformer extends TransformerAbstract
{
    /**
     * Transform the Insurance entity.
     *
     * @param \App\Entities\Insurance $model
     *
     * @return array
     */
    public function transform(Insurance $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
