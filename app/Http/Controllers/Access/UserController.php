<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Access\UserRequest;
use App\Repositories\Access\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CrudAPIController;

    public function __construct(User $repository)
    {
        $this->repository = $repository;
        $this->formRequest = UserRequest::class;
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        return $this->repository->update($data, $id);
    }
}
