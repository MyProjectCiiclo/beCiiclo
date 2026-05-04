<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'full_name',
        'title',
        'description',
        'projects',
        'years',
        'clients',
        'experience_years',
        'degree',
        'website',
        'email',
        'github',
        'linkedin',
        'avatar',
        'cv_url',
    ];

    public function skills()
    {
        return $this->hasMany(SkillModel::class, 'profile_id');
    }
}
