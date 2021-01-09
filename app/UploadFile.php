<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $fillable = [
        'user_file_id',                
        'name_file',
        'name_user',
        'url_file',
        'size_file'
    ];

    protected $dates = ['deleted_at'];

    public function userFile()
    {
        return $this->belongsTo(UserFile::class, 'user_file_id')->withTrashed();
    }
}
