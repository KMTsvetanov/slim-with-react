<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Model
{
    protected $table = 'post';

    protected $fillable = [
        'title',
        'content',
        'image',
    ];

    protected $casts = [
        'id' => 'int',
        'title' => 'string',
        'content' => 'string',
        'image' => 'string',
    ];
}