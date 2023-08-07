<?php

namespace App\Models\Report;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PcoReport extends Model
{
    protected $table = 'pco_reports';

    public $fillable = array(
        'user_id',
        'date_to_delete',
        'file',
        'file_name',
        'size',
    );

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
