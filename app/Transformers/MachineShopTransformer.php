<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MachineShop;

/**
 * Class MachineShopTransformer.
 *
 * @package namespace App\Transformers;
 */
class MachineShopTransformer extends TransformerAbstract
{
    /**
     * Transform the MachineShop entity.
     *
     * @param \App\Entities\MachineShop $model
     *
     * @return array
     */
    public function transform(MachineShop $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
