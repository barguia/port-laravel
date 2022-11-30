<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\AclProfileRequest;
use App\Repositories\AclProfileRepository;
use Illuminate\Http\Request;

class AclProfileController extends Controller
{
    use CrudAPIController;

    public function __construct(AclProfileRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = AclProfileRequest::class;
    }
}
