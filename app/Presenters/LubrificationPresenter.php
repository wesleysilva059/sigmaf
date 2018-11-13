<?php

namespace App\Presenters;

use App\Transformers\LubrificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LubrificationPresenter.
 *
 * @package namespace App\Presenters;
 */
class LubrificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new LubrificationTransformer();
    }
}
