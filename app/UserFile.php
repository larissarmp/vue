<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserFile
 *
 * @package App
 * @property string $group_id
 * @property string $name
 * @property string $group_name
 * @property string $email
*/

class UserFile extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'group_id',
        'name',
        'email',
        'group_name'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id')->withTrashed();
    }
}
