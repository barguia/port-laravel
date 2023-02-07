<?php

namespace App\Repositories\Workflow;

use App\Repositories\AbstractCRUDRepository;
use App\Models\Workflow\CtlProcessHierarchy as Model;

class CtlProcessHierarchyRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(Model::class);
    }
}
