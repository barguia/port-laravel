<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Ecommerce\CtlTask;
use App\Models\Ecommerce\PcoOrder;
use App\Repositories\Ecommerce\PcoTaskRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class TreatmentPcoTaskTest extends TestCase
{
    use UserAutenticado, WithFaker;
    use TestesCrud {
        testUsuarioNaoAutenticadoNaoPodeAcessarDelete as protected;
        testUsuarioAutenticadoPodeAcessarDelete as private;

        testUsuarioNaoAutenticadoNaoPodeAcessarStore as private;
        testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore as private;

        testUsuarioNaoAutenticadoNaoPodeAcessarShow as private;
        testUsuarioAutenticadoPodeAcessarShow as private;
        testRetornoRotaShowDeveConterArrayData as private;

        testRetornoRotaStoreDeveConterArrayData as private;
        testUsuarioNaoAutenticadoNaoPodeAcessarUpdate as private;
        testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate as private;
        testRetornoRotaUpdateDeveConterArrayData as private;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $order = PcoOrder::first();

        $this->rota = "/api/ecommerce/pco-tasks/";
        $this->repository = app(PcoTaskRepository::class);
        $ctlTask = CtlTask::first() ?? null;

        $this->dadosCreate = [
            'pco_order_id' => $order->id,
            'ctl_task_id' => $ctlTask->id
        ];

        $this->dadosUpdate = [
            'pco_order_id' => $order->id,
            'ctl_task_id' => $ctlTask->id
        ];
    }
}
