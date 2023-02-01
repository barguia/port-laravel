<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoTaskRequest;
use App\Repositories\Workflow\PcoTask as Repository;
use Illuminate\Http\Request;

class PcoTaskController extends Controller
{
    use CrudAPIController;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = PcoTaskRequest::class;
    }
}
