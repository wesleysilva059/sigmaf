<?php

namespace App\Presenters;

use App\Transformers\VehicleTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VehicleTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class VehicleTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VehicleTypeTransformer();
    }
}
