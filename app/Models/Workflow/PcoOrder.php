<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class PcoOrder extends Model
{
    protected $table = "pco_orders";

    public $fillable = array(
        'ctl_product_id',
        'price',
        'user_id',
    );
}
