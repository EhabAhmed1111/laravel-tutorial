<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    // this define which property will save inside db
    protected $fillable = [
        'title',
        'body',
        'author_id'
    ];

    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */ 
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
