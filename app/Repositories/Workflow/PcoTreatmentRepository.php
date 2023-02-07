<?php

namespace App\Repositories\Workflow;

use Illuminate\Support\Facades\Auth;

class PcoTreatmentRepository
{
    private $model;
    public function __construct()
    {
        $this->model = app(\App\Models\Workflow\PcoTreatment::class);
    }

    public function create($pcoTask)
    {
        return $this->model->create([
            'pco_task_id' => $pcoTask->id,
            'user_id' => Auth::user()->id,
        ]);
    }

    public function finish($treatment, $request = null)
    {
        $treatment->finalized_at = date('Y-m-d H:i:s');
        $treatment->ctl_task_id = $request->ctl_task_id ?? null;
        $treatment->update();
    }
}
