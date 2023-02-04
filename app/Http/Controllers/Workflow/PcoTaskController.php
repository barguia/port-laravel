<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoTaskRequest;
use App\Repositories\Workflow\PcoTask as Repository;

class PcoTaskController extends Controller
{
    use CrudAPIController {
        store as private;
        update as private;
        destroy as private;
    }

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->with = [
            "object",
            "task",
            "taskState",
            "process",
            "user",
        ];
    }

    public function store(PcoTaskRequest $request)
    {
        return $this->repository->newTask($request);
    }
}
