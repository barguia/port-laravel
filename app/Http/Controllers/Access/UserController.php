<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\UserRequest;
use App\Repositories\Access\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CrudAPIController;

    public function __construct(User $repository)
    {
        $this->repository = $repository;
        $this->formRequest = UserRequest::class;
        $this->middleware(['auth:api'])->except(['store']);
    }

    public function create(Request $request, $id)
    {
        $data = $request->all();
        $this->dataValidation($data);
        $data['password'] = bcrypt($data['password']);
        return $this->repository->create($data, $id);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->dataValidation($data);
        $data['password'] = bcrypt($data['password']);
        return $this->repository->update($data, $id);
    }
}
