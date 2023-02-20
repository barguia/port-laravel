<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Ecommerce\CtlProcess;
use App\Models\Ecommerce\CtlTask;
use App\Repositories\Ecommerce\CtlProductRepository;
use App\Repositories\Ecommerce\CtlTaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class CtlProductTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/ecommerce/ctl-products/";
        $this->repository = app(CtlProductRepository::class);

        $ctlTask = CtlTask::first();
        if (!$ctlTask) {
            $ctlTask = CtlTask::firstOrcreate([
                'task' => $this->faker->unique()->name,
                'ctl_process_id' => 1,
            ]);
        }


        $this->dadosCreate = [
            'product' => $this->faker->unique()->name,
            'description' => $this->faker->streetName,
            'ctl_default_task_id' => $ctlTask->id ?? null,
            'price' => rand(0.01, 20000)
        ];


        $this->dadosUpdate = [
            'product' => $this->faker->unique()->name,
            'description' => $this->faker->streetName,
            'ctl_default_task_id' => $ctlTask->id ?? null,
            'price' => rand(0.01, 20000)
        ];
    }
}
