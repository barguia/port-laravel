<?php

namespace Tests\Feature\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;

trait UserAutenticado
{
    use WithFaker;
    protected $user;
    protected $headers;
    protected $headersSemAutenticacao;

    private function callPassportInstall(): void
    {
        Artisan::call('passport:install');
    }

    private function setUserAutenticado(): void
    {
        $this->callPassportInstall();

        $this->user = User::factory()->make();
        $this->setHeaders();
    }

    private function setHeaders(): void
    {
        $this->setHeadersComAutenticacao();
        $this->setHeadersSemAutenticacao();
    }

    private function setHeadersSemAutenticacao(): void
    {
        $this->headersSemAutenticacao = ['Accept' => 'application/json'];
    }

    private function setHeadersComAutenticacao(): void
    {
        $headers = array();
        $headers['Authorization'] = 'Bearer ' . $this->user->createToken($this->user->email)->accessToken;
        $headers['Accept'] = 'application/json';
        $this->headers = $headers;
    }
}
