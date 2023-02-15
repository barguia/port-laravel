<?php

namespace App\Repositories\Workflow;

use App\Models\Workflow\PcoOrder;
use App\Repositories\AbstractCRUDRepository;

class PcoOrderRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(PcoOrder::class);
    }
}
