<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Access\AclProfileRequest;
use App\Repositories\Access\AclProfile;

class AclProfileController extends Controller
{
    use CrudAPIController;

    public function __construct(AclProfile $repository)
    {
        $this->repository = $repository;
        $this->formRequest = AclProfileRequest::class;
    }
}
