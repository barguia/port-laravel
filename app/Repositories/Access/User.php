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

    public function update(array $data, $id): Response
    {
        try {
            $record = $this->model->find($id);


            if ($record && $record->id) {
                foreach ($data as $indice => $field) {
                    if (in_array($indice, $this->model->fillable)) {
                        if ($indice == 'password') {
                            if (isset($data[$indice])) {
                                $record->$indice = bcrypt($data['password']);
                            }
                            continue;
                        }
                        $record->$indice = $data[$indice];
                    }
                }
                $record->update();

                return response(['data' => $record, 'message' => 'Successfully updated'], 200);
            }

            return response(['data' => '', 'message' => 'Record not found.'], 200);
        } catch (\Exception $error) {
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }
}
