<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\PcoProcess as PcoProcessModel;
use App\Models\Ecommerce\PcoTask;
use Illuminate\Support\Facades\Auth;

class PcoProcessRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app(PcoProcessModel::class);
    }

    public function create(array $data): PcoProcessModel
    {
        $data['user_id'] = Auth::user()->id;
        $process = $this->model->create($data);
        $this->verifyCreateProcess(null, $process);

        return $process;
    }

    private function finishProcess(PcoProcessModel $process): void
    {
        $process->finalized_at = date('Y-m-d H:i:s');
        $process->update();
    }

    private function getOpenProcess(?PcoTask $pcoTask = null, ?PcoProcessModel $process = null)
    {
        if ($pcoTask) {
            $ctlProcessId = $pcoTask->ctlTask->ctl_process_id;
        } else {
            $ctlProcessId = $process->ctlProcess->macroProcess->id ?? null;
        }

        return $this->model->where('ctl_process_id', $ctlProcessId)
            ->whereNull('finalized_at')
            ->first();
    }

    private function getOpenRelatedItems(int $pcoProcessId): int
    {
        $process = $this->model->where('pco_process_id', $pcoProcessId)
            ->whereNull('finalized_at')
            ->count();
        $tasks = PcoTask::where('pco_process_id', $pcoProcessId)
            ->whereNull('finalized_at')
            ->count();
        return $process + $tasks;
    }

    public function verifyCreateProcess(?PcoTask $pcoTask = null, ?PcoProcessModel $process = null): void
    {
        $openProcess = $this->getOpenProcess($pcoTask, $process);
        if (!$openProcess) {
            $data = [];

            if ($pcoTask) {
                $data = [
                    'ctl_process_id' => $pcoTask->ctlTask->ctl_process_id,
                    'pco_order_id' => $pcoTask->pco_order_id,
                ];
            } else {
                $ctlMacroProcessId = $process->ctlProcess->macroProcess->id ?? null;
                if ($ctlMacroProcessId) {
                    $data = [
                        'ctl_process_id' => $ctlMacroProcessId,
                        'pco_order_id' => $process->pco_order_id,
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

    public function verifyFinishProcess($pcoProcess): void
    {
        if ($this->getOpenRelatedItems($pcoProcess->id) == 0) {
            $this->finishProcess($pcoProcess);
        }
    }
}
