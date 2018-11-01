<?php

namespace App\Presenters;

use App\Transformers\OtherServiceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OtherServicePresenter.
 *
 * @package namespace App\Presenters;
 */
class OtherServicePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OtherServiceTransformer();
    }
}
