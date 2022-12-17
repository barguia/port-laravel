<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
//use App\Http\Requests\Workflow\CtlTaskRequest;
use App\Repositories\Workflow\CtlTask;

class CtlTaskController extends Controller
{
    use CrudAPIController;
    public function __construct(CtlTask $repository)
    {
        $this->repository = $repository;
//        $this->formRequest = CtlTaskRequest::class;
    }
}
