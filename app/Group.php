<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 *
 * @package App
 * @property string $name
*/

class Group extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name'];
    protected $hidden = [];

    protected $dates = ['deleted_at'];

    // public function userNew()
    // {
    //     return $this->hasMany(NewUser::class);
    // }
}
