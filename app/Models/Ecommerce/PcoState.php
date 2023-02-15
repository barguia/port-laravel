<?php

namespace App\Models\Ecommerce;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoState extends Model
{
    protected $table = 'pco_states';

    public $fillable = array(
        'ctl_state_id',
        'pco_order_id',
        'pco_task_id',
        'user_id',
    );

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
