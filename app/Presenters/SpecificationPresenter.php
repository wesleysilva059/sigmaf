<?php

namespace App\Presenters;

use App\Transformers\SpecificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SpecificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class SpecificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SpecificationTransformer();
    }
}
