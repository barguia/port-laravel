<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AclRoute extends Model
{
    use HasFactory;

    public $fillable = array('route');
}
