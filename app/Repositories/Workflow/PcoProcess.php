<?php

namespace App\Repositories\Workflow;

use App\Models\Workflow\PcoProcess as PcoProcessModel;
use App\Models\Workflow\PcoTask;

class PcoProcess
{
    protected $model;

    public function __construct()
    {
        $this->model = PcoProcessModel::class;
    }

    public function create(array $data): PcoProcessModel
    {
        $process = $this->model->create($data);
        $this->verifyCreateProcess(null, $process);

        return $process;
    }

    private function getOpenProcess(?PcoTask $pcoTask = null, ?PcoProcessModel $process = null)
    {
        if ($pcoTask) {
            $ctlProcessId = $pcoTask->ctlTask->ctl_process_id;
            $pcoPersonId = $pcoTask->pco_person_id;
        } else {
            $ctlProcessId = $process->ctlProcess->macroProcess->id ?? null;
            $pcoPersonId = $process->pco_person_id;
        }

        return $this->model->where('ctl_process_id', $ctlProcessId)
            ->where('pco_person_id', $pcoPersonId)
            ->whereNull('finalized_at')
            ->first();
    }

    public function verifyCreateProcess(?PcoTask $pcoTask = null, ?PcoProcessModel $process = null): void
    {
        $openProcess = $this->getOpenProcess($pcoTask, $process);
        if (!$openProcess) {
            $data = [];

            if ($pcoTask) {
                $data = [
                    'ctl_process_id' => $pcoTask->ctlTask->ctl_process_id,
                    'pco_person_id' => $pcoTask->pco_person_id,
                ];
            } else {
                $ctlMacroProcessId = $process->ctlProcess->macroProcess->id ?? null;
                if ($ctlMacroProcessId) {
                    $data = [
                        'ctl_process_id' => $ctlMacroProcessId,
                        'pco_person_id' => $process->pco_person_id,
                    ];
                }
            }

            if (!empty($data)) {
                $openProcess = $this->create($data);
            }
        }

        if (!$openProcess) {
            return;
        }

        if ($pcoTask) {
            $pcoTask->pco_process_id = $openProcess->id;
        } else {
            $process->pco_process_id = $openProcess->id;
        }
    }
}
