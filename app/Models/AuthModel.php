<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar'
    ];
}
