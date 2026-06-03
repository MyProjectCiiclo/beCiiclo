<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileModel extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'user_id',
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
        'phone',
        'location',
    ];

    public function stats()
    {
        return $this->hasOne(ProfileStats::class);
    }

    public function skills()
    {
        return $this->hasMany(SkillModel::class, 'profile_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(AuthModel::class, 'user_id');
    }
}
