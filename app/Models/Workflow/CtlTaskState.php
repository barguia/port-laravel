<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class CtlTaskState extends Model
{
    protected $table = 'ctl_tasks_states';
    public $fillable = array('state');
}
