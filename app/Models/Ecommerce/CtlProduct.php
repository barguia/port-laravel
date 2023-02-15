<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CtlProduct extends Model
{
    use SoftDeletes;

    public $table = 'ctl_products';
    public $fillable = [
        'product',
        'description',
        'price',
        'ctl_default_task_id',
        'user_id',
    ];
}
