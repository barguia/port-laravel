<?php

namespace App\Models\Access;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AclProfile extends Model
{
    use HasFactory;

    public $fillable = array('profile');
}
