<?php

namespace App\Repositories\Workflow;

use App\Models\Workflow\CtlTask;
use App\Models\Workflow\PcoTask as PcoTaskModel;
use Illuminate\Support\Facades\Auth;

class PcoTask
{
    protected $model;
    private PcoProcess $processRepository;

    public function __construct()
    {
        $this->model = PcoTaskModel::class;
        $this->processRepository = new PcoProcess();
    }

    public function create($peopleId, CtlTask $task): PcoTaskModel
    {
        $newTask = $this->model->create([
            'ctl_task_id' => $task->id,
            'pco_people_id' => $peopleId,
            'user_id' => Auth::user()->id,
        ]);

        $this->processRepository->verifyCreateProcess($newTask);

        $newTask->update();
        return $newTask;
    }
}
