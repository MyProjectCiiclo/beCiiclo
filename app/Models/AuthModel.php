<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AuthModel extends Authenticatable implements JWTSubject
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Trả về id user
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Thêm data vào token (hiện tại không dùng)
    public function getJWTCustomClaims()
    {
        return [];
    }
}