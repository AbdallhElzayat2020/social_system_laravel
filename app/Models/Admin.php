<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'admin_id');
    }

    /*  ==============  relationships ==================  */

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Authorization::class, 'role_id');
    }


    /*  ==============  Authorization Method ==================  */
    public function hasPermission($config_permission): bool
    {
        $authorization = $this->role;
        if (!$authorization) {
            return false;
        }

        foreach ($authorization->permissions as $permission) {
            if (config($config_permission) == $permission ?? false) {
                return true;
            }
        }


        //        return $this->role->permissions && in_array($permission, $this->role->permissions);
    }
}
