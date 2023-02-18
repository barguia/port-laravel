<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function pcoTasks(): HasMany
    {
        return $this->hasMany(PcoTask::class, 'pco_order_id');
    }

    public function pcoProcess(): HasMany
    {
        return $this->hasMany(PcoProcess::class, 'pco_order_id');
    }
}
