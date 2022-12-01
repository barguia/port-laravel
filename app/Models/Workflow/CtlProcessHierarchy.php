<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtlProcessHierarchy extends Model
{
    use HasFactory;

    public $table = "ctl_process_hierarchies";
    public $fillable = array(
        'hierarchy',
        'depth',
        'user_id',
    );
}
