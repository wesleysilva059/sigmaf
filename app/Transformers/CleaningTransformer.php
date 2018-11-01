<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Cleaning;

/**
 * Class CleaningTransformer.
 *
 * @package namespace App\Transformers;
 */
class CleaningTransformer extends TransformerAbstract
{
    /**
     * Transform the Cleaning entity.
     *
     * @param \App\Entities\Cleaning $model
     *
     * @return array
     */
    public function transform(Cleaning $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
