<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // this define which property will save inside db
    protected $fillable = [
        'title',
        'body',
        'author_id'
    ];
}
