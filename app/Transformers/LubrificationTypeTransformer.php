<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\LubrificationType;

/**
 * Class LubrificationTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class LubrificationTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the LubrificationType entity.
     *
     * @param \App\Entities\LubrificationType $model
     *
     * @return array
     */
    public function transform(LubrificationType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
