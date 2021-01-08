<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    
    protected $fillable = [
        'group_id',
        'name',
        'email',
        'group_name'
    ];
}
