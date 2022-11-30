<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\CtlProcessHierarchyRequest;
use App\Repositories\Workflow\CtlProcessHierarchy;

class CtlProcessHierarchyController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProcessHierarchy $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProcessHierarchyRequest::class;
    }
}
