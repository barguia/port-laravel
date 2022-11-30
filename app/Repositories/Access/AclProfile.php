<?php

namespace App\Repositories\Access;

use App\Models\Access\AclProfile as AclProfileModel;
use App\Repositories\AbstractCRUDRepository;

class AclProfile extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(AclProfileModel::class);
    }
}
