<?php

namespace App\Models\Workflow;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PcoProcess extends Model
{
    protected $table = 'pco_process';

    public $fillable = array(
        'ctl_process_id',
        'pco_object_id',
        'pco_process_id',
        'user_id',
    );

    public function object(): BelongsTo
    {
        return $this->belongsTo(PcoObject::class, 'pco_object_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(PcoTask::class, 'pco_process_id');
    }

    public function ctlProcess(): BelongsTo
    {
        return $this->belongsTo(CtlProcess::class, 'ctl_process_id');
    }

    public function pcoProcess(): HasMany
    {
        return $this->HasMany(PcoProcess::class, 'pco_process_id');
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
