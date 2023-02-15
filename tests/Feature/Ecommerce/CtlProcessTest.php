<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Workflow\CtlProcessHierarchy;
use App\Repositories\Ecommerce\CtlProcessRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class CtlProcessTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/wf/ctl-process/";
        $this->repository = app(CtlProcessRepository::class);
        $processHierarchy = CtlProcessHierarchy::first() ?? null;

        if ($processHierarchy === null) {
            $processHierarchy = CtlProcessHierarchy::create(
                [
                    'hierarchy' => $this->faker->name(),
                    'depth' => rand(0, 100),
                ]
            );
        }

        $this->dadosCreate = [
            'process' => $this->faker->unique()->name,
            'ctl_process_hierarchy_id' => $processHierarchy->id
        ];

        $this->dadosUpdate = [
            'process' => $this->faker->unique()->name,
            'ctl_process_hierarchy_id' => $processHierarchy->id
        ];
    }
}
