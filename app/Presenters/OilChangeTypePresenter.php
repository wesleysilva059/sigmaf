<?php

namespace App\Presenters;

use App\Transformers\OilChangeTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OilChangeTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class OilChangeTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OilChangeTypeTransformer();
    }
}
