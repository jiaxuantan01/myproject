<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Addresses extends Authenticatable
{
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'accid',
        'location',
        'ramark',
    ];
}
