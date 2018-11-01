<?php

namespace App\Presenters;

use App\Transformers\VehicleModelTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VehicleModelPresenter.
 *
 * @package namespace App\Presenters;
 */
class VehicleModelPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VehicleModelTransformer();
    }
}
