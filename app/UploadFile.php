<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'id_user_file',                
        'name_file',
        'name_user',
        'url_file',
        'size_file'
    ];

    protected $dates = ['deleted_at'];
}
