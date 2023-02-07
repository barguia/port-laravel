<?php

namespace Tests\Feature\Workflow;

use App\Repositories\Workflow\PcoObjectRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class PcoObjectTest extends TestCase
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
        $this->rota = "/api/wf/pco-objects/";
        $this->repository = app(PcoObjectRepository::class);

        $this->dadosCreate = [
            'description' => $this->faker->name,
        ];

        $this->dadosUpdate = [
            'description' => $this->faker->name,
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
