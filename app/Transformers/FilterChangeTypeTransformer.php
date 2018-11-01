<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\FilterChangeType;

/**
 * Class FilterChangeTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class FilterChangeTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the FilterChangeType entity.
     *
     * @param \App\Entities\FilterChangeType $model
     *
     * @return array
     */
    public function transform(FilterChangeType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
