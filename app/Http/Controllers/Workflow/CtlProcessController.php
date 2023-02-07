<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\CtlProcessRequest;
use App\Repositories\Workflow\CtlProcessRepository;

class CtlProcessController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProcessRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProcessRequest::class;
        $this->with = ['hierarchy', 'macroProcess'];
    }
}
