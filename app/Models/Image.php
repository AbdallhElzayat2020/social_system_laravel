<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $fillable = [
        'path',
        'post_id'
    ];

    public function post():BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
