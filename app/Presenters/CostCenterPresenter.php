<?php

namespace App\Presenters;

use App\Transformers\CostCenterTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CostCenterPresenter.
 *
 * @package namespace App\Presenters;
 */
class CostCenterPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CostCenterTransformer();
    }
}
