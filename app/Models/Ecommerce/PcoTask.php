<?php

namespace App\Models\Ecommerce;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoTask extends Model
{
    protected $table = 'pco_tasks';

    public $fillable = array(
        'ctl_task_id',
        'pco_order_id',
        'pco_process_id',
        'user_id',
    );

    public function pcoOrder(): BelongsTo
    {
        return $this->belongsTo(PcoOrder::class, 'pco_order_id');
    }

    public function ctlTask(): BelongsTo
    {
        return $this->belongsTo(CtlTask::class, 'ctl_task_id');
    }

    public function pcoState(): BelongsTo
    {
        return $this->belongsTo(PcoState::class, 'pco_state_id');
    }

    public function pcoProcess(): BelongsTo
    {
        return $this->belongsTo(PcoProcess::class, 'pco_process_id');
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userTreatment(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_treatment_id');
    }
}
