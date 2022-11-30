<?php

namespace App\Repositories;

use App\Models\AclProfile;

class AclProfileRepository extends AbstractCRUDRepository
{
    public function __construct()
    {
        $this->model = app(AclProfile::class);
    }
}
