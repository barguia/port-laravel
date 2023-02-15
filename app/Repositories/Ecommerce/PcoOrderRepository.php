<?php

namespace App\Repositories\Ecommerce;

use App\Models\Workflow\PcoOrder;
use App\Repositories\AbstractCRUDRepository;
use Illuminate\Http\Response;

class PcoOrderRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(PcoOrder::class);
    }

    public function store(array $data): Response
    {
        try {
            dd($data);
            return response(['data' => $this->model->create($data)], 200);
        } catch (\Exception $error) {
            dd($error);
            // return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }
}
