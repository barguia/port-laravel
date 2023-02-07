<?php

namespace App\Repositories\Workflow;

use App\Repositories\AbstractCRUDRepository;

class CtlProcessRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(\App\Models\Workflow\CtlProcess::class);
    }
}
