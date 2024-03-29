<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\PcoOrder;
use App\Models\Ecommerce\PcoTask as PcoTaskModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PcoTaskRepository
{
    protected $model;
    private array $with = [
        "pcoOrder",
        "ctlTask",
        "pcoState",
        "pcoProcess",
        "registeredBy",
        "userTreatment",
    ];
    private PcoProcessRepository $processRepository;
    private PcoTaskModel | null $pcoTask = null;
    private PcoStateRepository $stateRepository;
    private PcoTreatmentRepository $treatmentRepository;

    public function __construct(?int $pcoTaskId = null)
    {
        $this->model = app(PcoTaskModel::class);
        $this->processRepository = new PcoProcessRepository();
        $this->treatmentRepository = new PcoTreatmentRepository();
        $this->stateRepository = new PcoStateRepository();

        if ($pcoTaskId) {
            $this->setTaskObject($pcoTaskId);
        }
    }

    public function getTaskModel()
    {
        return $this->pcoTask;
    }

    private function setTaskObject(int $pcoTaskId): void
    {
        $this->pcoTask = $this->model->with($this->with)->find($pcoTaskId);
    }

    private function responseHttp($data, String $message = "", ?int $statusCode = 200): Response
    {
        return response(
            [
                'data' => $data,
                'message' => $message
            ],
            $statusCode
        );
    }

    public function index(): Response
    {
        try {
            $records = $this->model->with($this->with)->get();
            return $this->responseHttp($records, 'Records found successfully.');
        } catch (\Exception $error) {
            dd($error);
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }

    public function newTask(PcoOrder $order): void
    {
        if (!$order || !$order->ctlProduct || !$order->ctlProduct->ctl_default_task_id) {
            return;
        }

        try {
            $newTask = $this->model->create([
                'ctl_task_id' => $order->ctlProduct->ctl_default_task_id,
                'pco_order_id' => $order->id,
                'user_id' => Auth::user()->id,
            ]);
            $newTask->pco_state_id = $this->stateRepository->startStateDefault($newTask);
            $this->processRepository->verifyCreateProcess($newTask);

            $newTask->update();

        } catch (\Exception $error) {
            dd($error);
        }
    }

    public function adopt(): Response
    {
        return $this->transfer(Auth::user()->id);
    }

    public function appropriate(): Response
    {
        return $this->adopt();
    }

    public function transfer(int $userId)
    {
        $this->pcoTask->user_treatment_id = $userId;
        $this->pcoTask->update();
        $this->setTaskObject($this->pcoTask->id);
        return $this->responseHttp($this->pcoTask);
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
