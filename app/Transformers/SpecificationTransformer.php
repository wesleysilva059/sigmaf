<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Specification;

/**
 * Class SpecificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class SpecificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Specification entity.
     *
     * @param \App\Entities\Specification $model
     *
     * @return array
     */
    public function transform(Specification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
