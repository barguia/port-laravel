<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtlProcess extends Model
{
    protected $table = "ctl_process";

    public $fillable = [
        'process',
        'ctl_process_hierarchy_id',
        'ctl_process_id',
    ];

    public function subProcess(): HasMany
    {
        return $this->hasMany(self::class, 'ctl_process_id');
    }

    public function macroProcess(): BelongsTo
    {
        return $this->belongsTo(self::class, 'ctl_process_id');
    }
}
