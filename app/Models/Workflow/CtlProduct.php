<?php

namespace App\Models\Workflow;

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
        'user_id',
    ];
}
