<?php

namespace Tests\Feature;

use App\Models\AclProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class AclProfileTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/adm/profiles/";
        $this->model = app(AclProfile::class);


        $this->dadosCreate = [
            'profile' => $this->faker->unique()->name,
        ];

        $this->dadosUpdate = [
            'profile' => $this->faker->unique()->name,
        ];
    }

    /**
     * @depends testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore
     * @param array $data
     * @return void
     */
    public function testAssertCantRegisterADuplicateProfile(array $data): void
    {
        $data = [
            'profile' => $data['data']['profile']
        ];
        $response = $this->actingAs($this->user, 'api')
            ->post($this->rota, $data);

        $response->assertStatus(302);
    }
}
