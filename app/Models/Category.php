<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];


    /*
     *================================
     * RelationShip
     *  *================================
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    /*
     *================================
     * Scopes
     *  *================================
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
