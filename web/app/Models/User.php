<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}