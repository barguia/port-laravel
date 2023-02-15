<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\CtlProductRequest;
use App\Repositories\Workflow\CtlProductRepository;

class CtlProductController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProductRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProductRequest::class;
    }
}
