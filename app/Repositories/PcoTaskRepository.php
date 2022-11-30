<?php

namespace App\Repositories;

use App\Models\CtlTask;
use App\Models\PcoTask;
use Illuminate\Support\Facades\Auth;

class PcoTaskRepository
{
    protected $model;
    private PcoProcessRepository $processRepository;

    public function __construct()
    {
        $this->model = PcoTask::class;
        $this->processRepository = new PcoProcessRepository();
    }

    public function create($peopleId, CtlTask $task): PcoTask
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
