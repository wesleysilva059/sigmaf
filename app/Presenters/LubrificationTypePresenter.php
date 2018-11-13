<?php

namespace App\Presenters;

use App\Transformers\LubrificationTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LubrificationTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class LubrificationTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LubrificationTypeTransformer();
    }
}
