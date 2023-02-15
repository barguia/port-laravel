<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoOrder extends Model
{
    protected $table = "pco_orders";

    public $fillable = array(
        'ctl_product_id',
        'price',
        'user_id',
    );

    public function ctlProduct(): BelongsTo
    {
        return $this->belongsTo(CtlProduct::class, 'ctl_product_id');
    }
}
