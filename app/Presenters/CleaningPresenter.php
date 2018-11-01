<?php

namespace App\Presenters;

use App\Transformers\CleaningTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CleaningPresenter.
 *
 * @package namespace App\Presenters;
 */
class CleaningPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CleaningTransformer();
    }
}
