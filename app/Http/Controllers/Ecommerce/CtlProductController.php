<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Ecommerce\CtlProductRequest;
use App\Repositories\Ecommerce\CtlProductRepository;

class CtlProductController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProductRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProductRequest::class;
    }
}
