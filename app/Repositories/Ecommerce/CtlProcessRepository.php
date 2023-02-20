<?php

namespace App\Repositories\Ecommerce;

use App\Repositories\AbstractCRUDRepository;

class CtlProcessRepository extends AbstractCRUDRepository
{
    protected array $with = array(
        'macroProcess',
        'hierarchy',
    );
    public function __construct()
    {
        $this->model = app(\App\Models\Ecommerce\CtlProcess::class);
    }
}
