<?php

namespace App\Presenters;

use App\Transformers\MaintenanceCategoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MaintenanceCategoryPresenter.
 *
 * @package namespace App\Presenters;
 */
class MaintenanceCategoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MaintenanceCategoryTransformer();
    }
}
