<?php

namespace App\Repositories\Workflow;

use App\Repositories\AbstractCRUDRepository;

class PcoObjectRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(\App\Models\Workflow\PcoObject::class);
    }
}
