<?php

namespace App\Repositories\Ecommerce;

use App\Repositories\AbstractCRUDRepository;
use App\Models\Ecommerce\CtlProcessHierarchy as Model;

class CtlProcessHierarchyRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(Model::class);
    }
}
