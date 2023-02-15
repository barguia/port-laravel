<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Ecommerce\CtlTaskRequest;
use App\Repositories\Ecommerce\CtlTaskRepository;

class CtlTaskController extends Controller
{
    use CrudAPIController;
    public function __construct(CtlTaskRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlTaskRequest::class;
    }
}
