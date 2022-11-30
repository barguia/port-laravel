<?php

namespace Tests\Feature\Traits;

trait TestesCrud
{
    protected $rota;
    protected $model;
    protected $dadosCreate = array();
    protected $dadosUpdate = array();
    protected $modelObject;

    public function testUsuarioNaoAutenticadoNaoPodeAcessarIndex()
    {
        $response = $this->get($this->rota, $this->headersSemAutenticacao);
        $response->assertStatus(401);
    }

    /**
     * @return array
     */
    public function testUsuarioAutenticadoPodeAcessarIndex(): array
    {
        $response = $this->actingAs($this->user, 'api')->get($this->rota);
        $response->assertStatus(200);
        return $response->json();
    }

    /**
     * @param array $dados
     * @depends testUsuarioAutenticadoPodeAcessarIndex
     * @return void
     */
    public function testRetornoRotaIndexDeveConterArrayData(array $dados): void
    {
        $this->assertArrayHasKey('data', $dados);
    }

    public function testUsuarioNaoAutenticadoNaoPodeAcessarStore()
    {
        $response = $this->post($this->rota, $this->dadosCreate, $this->headersSemAutenticacao);
        $response->assertStatus(401);
    }

    /**
     * @return array
     */
    public function testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore(): array
    {
        $response = $this->actingAs($this->user, 'api')->post($this->rota, $this->dadosCreate);
        $response->assertStatus(201);
        return $response->json();
    }

    /**
     * @param array $dados
     * @depends testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore
     * @return void
     */
    public function testRetornoRotaStoreDeveConterArrayData(array $dados): void
    {
        $this->assertArrayHasKey('data', $dados);
    }

    /**
     * @param array $dados
     * @depends testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore
     * @return void
     */
    public function testUsuarioNaoAutenticadoNaoPodeAcessarShow(array $dados): void
    {
        $response = $this->get($this->rota . $dados['data']['id'], $this->headersSemAutenticacao);
        $response->assertStatus(401);
    }

    /**
     * @param array $dados
     * @depends testUsuarioEnviouDadosObrigatoriosEPodeAcessarStore
     * @return array
     */
    public function testUsuarioAutenticadoPodeAcessarShow(array $dados): array
    {
        $response = $this->actingAs($this->user, 'api')
            ->get($this->rota . $dados['data']['id']);
        $response->assertStatus(200);
        return $response->json();
    }


    /**
     * @depends testUsuarioAutenticadoPodeAcessarShow
     * @param array $dados
     */
    public function testRetornoRotaShowDeveConterArrayData(array $dados): void
    {
        $this->assertArrayHasKey('data', $dados);
    }

    /**
     * @depends testUsuarioAutenticadoPodeAcessarShow
     */
    public function testUsuarioNaoAutenticadoNaoPodeAcessarUpdate(array $dados): void
    {
        $response = $this->patch(
            $this->rota . $dados['data']['id'],
            $this->dadosUpdate,
            $this->headersSemAutenticacao
        );
        $response->assertStatus(401);
    }

    /**
     * @depends testUsuarioAutenticadoPodeAcessarShow
     * @return array
     */
    public function testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate(array $dados): array
    {
        $response = $this->actingAs($this->user, 'api')
            ->patch($this->rota . $dados['data']['id'], $this->dadosUpdate);
        $response->assertStatus(200);
        return $response->json();
    }

    /**
     * @depends testUsuarioAutenticadoPodeAcessarShow
     * @param array $dados
     */
    public function testRetornoRotaUpdateDeveConterArrayData(array $dados): void
    {
        $this->assertArrayHasKey('data', $dados);
    }

    /**
     * @depends testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate
     */
    public function testUsuarioNaoAutenticadoNaoPodeAcessarDelete(array $dados): void
    {
        $response = $this->delete($this->rota . $dados['data']['id'], [], $this->headersSemAutenticacao);
        $response->assertStatus(401);
    }

    /**
     * @depends testUsuarioAutenticadoEnviouTiposDadosCorretosEPodeAcessarUpdate
     */
    public function testUsuarioAutenticadoPodeAcessarDelete(array $dados): void
    {
        $response = $this->actingAs($this->user, 'api')
            ->delete($this->rota . $dados['data']['id'], [], $this->headers);
        $response->assertStatus(200);
    }
}
