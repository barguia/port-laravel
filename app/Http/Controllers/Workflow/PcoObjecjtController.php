<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Workflow\PcoObjectRequest;
use App\Repositories\Workflow\PcoObjectRepository;

class PcoObjecjtController extends Controller
{
    use CrudAPIController;

    public function __construct(PcoObjectRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = PcoObjectRequest::class;
    }
}
