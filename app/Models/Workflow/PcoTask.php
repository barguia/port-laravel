<?php

namespace App\Models\Workflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoTask extends Model
{
    protected $table = 'pco_tasks';

    public $fillable = array(
        'ctl_task_id',
        'pco_person_id',
        'pco_process_id'
    );

    public function person(): BelongsTo
    {
        return $this->belongsTo(PcoObject::class, 'pco_person_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(CtlTask::class, 'ctl_task_id');
    }

    public function taskState(): BelongsTo
    {
        return $this->belongsTo(PcoTaskState::class, 'pco_task_state_id');
    }

    public function process(): BelongsTo
    {
        return $this->belongsTo(PcoProcess::class, 'pco_process_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
