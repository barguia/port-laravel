<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Model;

class CtlState extends Model
{
    protected $table = 'ctl_states';
    public $fillable = array('state');
}
