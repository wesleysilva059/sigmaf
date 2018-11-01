<?php

namespace App\Presenters;

use App\Transformers\MaintenanceTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MaintenancePresenter.
 *
 * @package namespace App\Presenters;
 */
class MaintenancePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MaintenanceTransformer();
    }
}
