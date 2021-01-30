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
}