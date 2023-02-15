<?php

namespace App\Repositories\Ecommerce;

use App\Repositories\AbstractCRUDRepository;

class CtlTaskRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(\App\Models\Ecommerce\CtlTask::class);
    }
}
