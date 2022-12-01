<?php

namespace Tests\Feature\Access;

use App\Repositories\Access\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Traits\TestesCrud;
use Tests\Feature\Traits\UserAutenticado;
use Tests\TestCase;

class UserTest extends TestCase
{
    use UserAutenticado, TestesCrud, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUserAutenticado();
        $this->rota = "/api/users/";
        $this->repository = app(User::class);

        $pass1 = $this->faker->password;
        $pass2 = $this->faker->password;

        $this->dadosCreate = [
            'name' => $this->faker->name,
            'email' => $this->faker()->unique()->email,
            'password' => $pass1,
            'password_confirmation' => $pass1
        ];

        $this->dadosUpdate = [
            'name' => $this->faker->name,
            'email' => $this->faker()->unique()->email,
            'password' => $pass2,
            'password_confirmation' => $pass2
        ];
    }

//    public function testUsuarioNaoAutenticadoNaoPodeAcessarStore()
//    {
//        $response = $this->post($this->rota . $this->user->id, $this->dadosUpdate, $this->headers);
//        $response->assertStatus(401);
//    }

    /**
     * @depends testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore
     */
    public function testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate(array $data): array
    {
        $user_id = $data['data']['id'];
        $user = $this->repository->getModelById($user_id);

        $response = $this->actingAs($user, 'api')
            ->put(
                $this->rota . $user_id,
                $this->dadosUpdate,
                $this->headers
            );

        $response->assertStatus(200);

        return $response->json();
    }
}
