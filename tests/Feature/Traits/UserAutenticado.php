<?php

namespace Tests\Feature\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

        $this->user = User::firstOrCreate(
            [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]
        );

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
        $this->headers = array();
        $this->headers['Authorization'] = 'Bearer ' . $this->user->createToken($this->user->email)->accessToken;
        $this->headers['Accept'] = 'application/json';
    }
}
