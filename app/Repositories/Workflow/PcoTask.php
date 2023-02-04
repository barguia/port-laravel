<?php

namespace App\Repositories\Workflow;

use App\Models\Workflow\CtlTask;
use App\Models\Workflow\PcoTask as PcoTaskModel;
use App\Repositories\AbstractCRUDRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PcoTask
{
    protected $model;
    private PcoProcess $processRepository;
    private $pcoTask = null;

    public function __construct()
    {
        $this->model = app(PcoTaskModel::class);
        $this->processRepository = new PcoProcess();
        $this->treatmentRepository = new PcoTreatment();
    }

    private function responseHttp($data, int $statusCode = 200, String $message = ""): Response
    {
        return response(
            [
                'data' => $data,
                'message' => $message
            ],
            $statusCode
        );
    }

    public function index(array $with = []): Response
    {
        try {
            $records = $this->model->with($with)->get();
            return $this->responseHttp($records, 200, 'Records found successfully.');
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function newTask(Request $request): Response
    {
        try {
            $newTask = $this->model->create([
                'ctl_task_id' => $request->ctl_task_id,
                'pco_object_id' => $request->pco_object_id,
                'user_id' => Auth::user()->id,
            ]);

            $this->processRepository->verifyCreateProcess($newTask);

            $newTask->update();
            return $this->responseHttp($newTask);
        } catch (\Exception $error) {
            dd($error);
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function adopt(): bool
    {
        return $this->transfer(Auth::user()->id);
    }

    public function appropriate(): bool
    {
        return $this->adopt();
    }

    public function transfer(int $userId): bool
    {
        $this->pcoTask->user_tratment_id = $userId;
        $this->pcoTask->update();
        return true;
    }

    public function startTreatment(): int
    {
        $treatment = $this->treatmentRepository->create($this->pcoTask);
        $this->pcoTask->pco_treatment_id = $treatment->id;
        $this->pcoTask->update();
        return $treatment->id;
    }

    public function finishTreatment($request): void
    {
        $this->treatmentRepository->finish($this->pcoTask->pcoTratament, $request);

        if ($request->ctl_task_id) {
            $this->create($request->ctl_task_id);
            $this->pcoTask->finalized_at = date('Y-m-d H:i:s');
            $this->pcoTask->update();

            $this->processRepository->verifyFinishProcess($this->pcoTask->pcoProcess);
        }
    }
}
