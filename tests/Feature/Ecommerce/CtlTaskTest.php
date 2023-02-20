<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Ecommerce\CtlProcess;
use App\Repositories\Ecommerce\CtlTaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class CtlTaskTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/ecommerce/ctl-tasks/";
        $this->repository = app(CtlTaskRepository::class);
        $process = CtlProcess::first() ?? null;

        $this->dadosCreate = [
            'task' => $this->faker->unique()->name,
            'ctl_process_id' => $process->id
        ];

        $this->dadosUpdate = [
            'task' => $this->faker->unique()->name,
            'ctl_process_id' => $process->id
        ];
    }
}
