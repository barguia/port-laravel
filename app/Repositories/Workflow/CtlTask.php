<?php

namespace App\Repositories\Workflow;

use App\Repositories\AbstractCRUDRepository;

class CtlTask extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(\App\Models\Workflow\CtlTask::class);
    }
}
