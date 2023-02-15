<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoOrderRequest;
use App\Repositories\Workflow\PcoOrderRepository;

class PcoOrderController extends Controller
{
    use CrudAPIController;

    public function __construct(PcoOrderRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = PcoOrderRequest::class;
    }
}
