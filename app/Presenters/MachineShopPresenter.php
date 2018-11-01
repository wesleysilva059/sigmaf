<?php

namespace App\Presenters;

use App\Transformers\MachineShopTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MachineShopPresenter.
 *
 * @package namespace App\Presenters;
 */
class MachineShopPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MachineShopTransformer();
    }
}
