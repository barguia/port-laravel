<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Ecommerce\CtlProcessHierarchy;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class CtlProcessHierarchyTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/ecommerce/ctl-process-hierarchies/";
        $this->model = app(CtlProcessHierarchy::class);

        $this->dadosCreate = [
            'hierarchy' => $this->faker->unique()->name,
            'depth' => rand(0, 1000),
        ];

        $this->dadosUpdate = [
            'hierarchy' => $this->faker->unique()->name,
            'depth' => rand(0, 1000),
        ];
    }
}
