<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillModel extends Model
{
    protected $table = 'skills';

    protected $fillable = [
        'profile_id',
        'name',
        'image',
        'weight',
    ];

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class, 'profile_id', 'id');
    }
}
