<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlTaskState extends Model
{
    protected $table = 'ctl_tasks_states';
    public $fillable = array('state');
}
