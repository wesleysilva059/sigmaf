<?php

namespace App\Presenters;

use App\Transformers\OilChangeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OilChangePresenter.
 *
 * @package namespace App\Presenters;
 */
class OilChangePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OilChangeTransformer();
    }
}
