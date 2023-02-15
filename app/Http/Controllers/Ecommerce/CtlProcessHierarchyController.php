<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Ecommerce\CtlProcessHierarchyRequest;
use App\Repositories\Ecommerce\CtlProcessHierarchyRepository;

class CtlProcessHierarchyController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProcessHierarchyRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProcessHierarchyRequest::class;
    }
}
