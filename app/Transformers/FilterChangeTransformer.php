<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\FilterChange;

/**
 * Class FilterChangeTransformer.
 *
 * @package namespace App\Transformers;
 */
class FilterChangeTransformer extends TransformerAbstract
{
    /**
     * Transform the FilterChange entity.
     *
     * @param \App\Entities\FilterChange $model
     *
     * @return array
     */
    public function transform(FilterChange $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
