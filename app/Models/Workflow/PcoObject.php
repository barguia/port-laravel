<?php

namespace App\Models\Workflow;

use Illuminate\Database\Eloquent\Model;

class PcoObject extends Model
{
    protected $table = "pco_objects";
    public $fillable = array(
        'description',
        'user_id',
    );
}
