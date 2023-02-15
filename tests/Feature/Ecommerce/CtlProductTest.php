<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Workflow\CtlProcess;
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
        $this->rota = "/api/wf/ctl-products/";
        $this->repository = app(CtlProductRepository::class);

        $this->dadosCreate = [
            'product' => $this->faker->unique()->name,
            'description' => $this->faker->streetName,
            'price' => rand(0.01, 20000)
        ];


        $this->dadosUpdate = [
            'product' => $this->faker->unique()->name,
            'description' => $this->faker->streetName,
            'price' => rand(0.01, 20000)
        ];
    }
}
