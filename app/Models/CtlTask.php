<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CtlTask extends Model
{
    protected $table = 'ctl_tasks';

    public $fillable = array([
        'task',
        'ctl_process_id'
    ]);

    public function process(): BelongsTo
    {
        return $this->belongsTo(CtlProcess::class, 'ctl_process_id');
    }
}
