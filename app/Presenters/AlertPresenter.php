<?php

namespace App\Presenters;

use App\Transformers\AlertTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AlertPresenter.
 *
 * @package namespace App\Presenters;
 */
class AlertPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AlertTransformer();
    }
}
