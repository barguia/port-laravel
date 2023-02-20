<?php

namespace Tests\Feature\Ecommerce;

use App\Models\Ecommerce\CtlProduct;
use App\Repositories\Ecommerce\PcoOrderRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class PcoOrderTest extends TestCase
{
    use UserAutenticado, WithFaker;
    use TestesCrud {
        testUsuarioNaoAutenticadoNaoPodeAcessarDelete as protected;
        testUsuarioAutenticadoPodeAcessarDelete as private;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/ecommerce/pco-orders/";
        $this->repository = app(PcoOrderRepository::class);
        $ctlProduct = CtlProduct::firstOrcreate([
            'product' => $this->faker->unique()->name,
            'description' => $this->faker->streetName,
            'price' => rand(0.01, 20000)
        ]);

        $this->dadosCreate = array(
            'description' => $this->faker->name,
            'ctl_product_id' => $ctlProduct->id,
            'price' => rand(0.01, 10000),
        );


        $this->dadosUpdate = [
            'description' => $this->faker->name,
            'ctl_product_id' => $ctlProduct->id,
            'price' => rand(0.01, 10000),
        ];
    }

    /**
     * @depends testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate
     */
    public function testUsuarioAutenticadoNaoPodeAcessarDelete(array $dados): void
    {
        $response = $this->actingAs($this->user, 'api')
            ->delete($this->rota . $dados['data']['id'], [], $this->headers);
        $response->assertStatus(405);
    }
}
