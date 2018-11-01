<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Mark;

/**
 * Class MarkTransformer.
 *
 * @package namespace App\Transformers;
 */
class MakeTransformer extends TransformerAbstract
{
    /**
     * Transform the Mark entity.
     *
     * @param \App\Entities\Mark $model
     *
     * @return array
     */
    public function transform(Make $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
