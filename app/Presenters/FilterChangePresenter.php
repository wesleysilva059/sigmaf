<?php

namespace App\Presenters;

use App\Transformers\FilterChangeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FilterChangePresenter.
 *
 * @package namespace App\Presenters;
 */
class FilterChangePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FilterChangeTransformer();
    }
}
