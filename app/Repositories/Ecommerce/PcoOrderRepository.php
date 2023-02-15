<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\PcoOrder;
use App\Repositories\AbstractCRUDRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PcoOrderRepository extends AbstractCRUDRepository
{
    private CtlProductRepository $ctlProductRepository;
    private PcoTaskRepository $pcoTaskRepository;

    public function __construct()
    {
        $this->model = app(PcoOrder::class);
        $this->ctlProductRepository = new CtlProductRepository();
        $this->pcoTaskRepository = new PcoTaskRepository();
    }

    public function create(array $data): Response
    {
        try {
            DB::beginTransaction();
            $product = $this->ctlProductRepository->getModelById($data['ctl_product_id']);
            $data['price'] = $product->price;
            $response = $this->store($data);
            $object = $response->original['data'];
            $this->pcoTaskRepository->newTask($object);
            DB::commit();
            return $response;
        } catch (\Exception $error) {
            DB::rollBack();
            dd($error);
            return response(['message' => 'Something wrong happen. Try again.'], 500);
        }
    }
}
