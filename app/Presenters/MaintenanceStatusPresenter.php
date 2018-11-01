<?php

namespace App\Presenters;

use App\Transformers\MaintenanceStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MaintenanceStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class MaintenanceStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MaintenanceStatusTransformer();
    }
}
