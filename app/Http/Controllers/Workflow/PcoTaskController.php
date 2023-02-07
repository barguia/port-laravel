<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoTaskRequest;
use App\Models\User;
use App\Models\Workflow\PcoTask;
use App\Repositories\Workflow\PcoTaskRepository as Repository;
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

    public function adopt(PcoTask $pcoTask): Response
    {
        $repository = new Repository($pcoTask->id);
        return $repository->adopt();
    }

    public function transfer(PcoTask $pcoTask, User $user): Response
    {
        $repository = new Repository($pcoTask->id);
        return $repository->transfer($user->id);
    }
}
