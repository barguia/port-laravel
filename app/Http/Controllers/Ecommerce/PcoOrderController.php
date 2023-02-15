<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CrudAPIController;
use App\Http\Requests\Ecommerce\PcoOrderRequest;
use App\Repositories\Ecommerce\PcoOrderRepository;

class PcoOrderController extends Controller
{
    use CrudAPIController;

    public function __construct(PcoOrderRepository $repository)
    {
        $this->repository = $repository;
        $this->formRequest = PcoOrderRequest::class;
    }
}
