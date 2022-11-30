<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlProcessHierarchy extends Model
{
    protected $table = "ctl_process_hierarchies";
    public $fillable = array('hierarchy');
}
