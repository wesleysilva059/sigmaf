<?php

namespace App\Presenters;

use App\Transformers\VehicleTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VehiclePresenter.
 *
 * @package namespace App\Presenters;
 */
class VehiclePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VehicleTransformer();
    }
}
