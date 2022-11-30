<?php

namespace App\Repositories\Access;

use App\Models\User as UserModel;
use App\Repositories\AbstractCRUDRepository;
use Illuminate\Http\Response;

class User extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(UserModel::class);
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
