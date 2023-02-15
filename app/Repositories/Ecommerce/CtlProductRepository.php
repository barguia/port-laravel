<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\CtlProduct;
use App\Repositories\AbstractCRUDRepository;

class CtlProductRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(CtlProduct::class);
    }
}
