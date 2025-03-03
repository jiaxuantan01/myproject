<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AddressType extends Authenticatable
{
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $fillable = [
        'name',
        'remark',
        'status',
    ];

    public static function getAddressTypes(){

        $data = self::where('status',1)->get();

        return $data;
    }
}
