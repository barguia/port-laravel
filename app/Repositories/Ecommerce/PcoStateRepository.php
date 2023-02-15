<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\PcoTask as PcoTaskModel;
use \App\Models\Ecommerce\PcoState as PcoStateModel;
use Illuminate\Support\Facades\Auth;

class PcoStateRepository
{
    const STATE_TO_DO = 1;
    const STATE_IN_PROGRESS = 2;
    const STATE_IMPEDIMENT = 3;

    public function __construct()
    {
        $this->model = app(PcoStateModel::class);
    }

    public function create(PcoTaskModel $task, int $ctlTaskStateId)
    {
        return $this->model->create([
            'user_id' => Auth::user()->id,
            'pco_task_id' => $task->id,
            'pco_order_id' => $task->pco_order_id,
            'pco_last_task_state_id' => $task->pco_task_state_id ?? null,
            'ctl_state_id' => $ctlTaskStateId,
        ]);
    }

    public function startStateDefault(PcoTaskModel $task): int
    {
        return $this->create($task, self::STATE_TO_DO)->id;
    }
}
