<?php

namespace App\Presenters;

use App\Transformers\FilterChangeTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FilterChangeTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class FilterChangeTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new FilterChangeTypeTransformer();
    }
}
