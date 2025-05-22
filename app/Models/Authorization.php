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

    /*  Accessors for json_decode permissions  */
    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}
