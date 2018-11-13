<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Lubrification;

/**
 * Class LubrificationTransformer.
 *
 * @package namespace App\Transformers;
 */
class LubrificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Lubrification entity.
     *
     * @param \App\Entities\Lubrification $model
     *
     * @return array
     */
    public function transform(Lubrification $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
