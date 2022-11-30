<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Response;

class UserRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(User::class);
    }

    public function create(array $data): Response
    {
        $data['password'] = bcrypt($data['password']);

        $user = $this->model->create($data);
        $user->access_token = $user->createToken($user->email)->accessToken;

        return response(
            [
                'data' => $user,
                'message' => 'Successfully created.'
            ],
            201
        );
    }
}
