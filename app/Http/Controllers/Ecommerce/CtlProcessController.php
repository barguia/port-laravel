<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Ecommerce\CtlProcessRequest;
use App\Repositories\Ecommerce\CtlProcessRepository;

class CtlProcessController extends Controller
{
    use CrudAPIController;

    public function __construct(CtlProcessRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = CtlProcessRequest::class;
        $this->with = ['hierarchy', 'macroProcess'];
    }
}
