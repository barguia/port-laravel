<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoTaskRequest;
use App\Repositories\Workflow\PcoTask as Repository;
use Illuminate\Http\Response;

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
    }

    public function store(PcoTaskRequest $request): Response
    {
        return $this->repository->newTask($request);
    }

    public function adopt($pcoTaskId): Response
    {
        $repository = new Repository($pcoTaskId);
        return $repository->adopt();
    }

    public function transfer($pcoTaskId, $userId): Response
    {
        $repository = new Repository($pcoTaskId);
        return $repository->transfer($userId);
    }
}
