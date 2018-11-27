<?php

namespace App\Presenters;

use App\Transformers\InsuranceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InsurancePresenter.
 *
 * @package namespace App\Presenters;
 */
class InsurancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InsuranceTransformer();
    }
}
