<?php

namespace App\Models\Ecommerce;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoTreatment extends Model
{
    protected $table = 'pco_tratamentos';

    public $fillable = array(
        'ctl_task_id',
        'pco_task_id',
    );

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(CtlTask::class, 'ctl_task_id');
    }
}
