<?php

namespace App\Repositories\Workflow;

use App\Repositories\AbstractCRUDRepository;

class PcoObject extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(\App\Models\Workflow\PcoObject::class);
    }
}
