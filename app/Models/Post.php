<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'comment_able',
        'status',
        'user_id',
        'category_id',
        'meta_title',
        'meta_description',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }


    /**
     *================================
     * RelationShip
     * ================================
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function images(): hasMany
    {
        return $this->hasMany(Image::class, 'post_id');
    }


    /**
     *================================
     * Scopes
     * ================================
     */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    #[Scope]
    protected function activeUser(Builder $query): Builder
    {
        return $query->whereStatus('active');
    }

    #[Scope]
    protected function activeCategory(Builder $query): Builder
    {
        return $query->whereStatus('active');
    }
}
