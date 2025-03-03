<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Document extends Authenticatable
{
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = ['file_name', 'file_path', 'file_type'];

}
