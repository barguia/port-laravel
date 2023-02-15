<?php

namespace App\Repositories\Workflow;

use App\Models\Workflow\CtlProduct;
use App\Repositories\AbstractCRUDRepository;

class CtlProductRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(CtlProduct::class);
    }
}
