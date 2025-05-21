<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Authorization extends Model
{
    protected $fillable = [
        'role_name',
        'permissions',
        'status',
    ];

    /*  Accessors */
    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }

}
