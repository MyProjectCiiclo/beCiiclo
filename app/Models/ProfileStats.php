<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileStats extends Model
{
    protected $table = 'profile_stats';

    protected $fillable = [
        'profile_id',
        'projects',
        'clients',
        'years',
        'experience_years',
    ];

    public function profile()
    {
        return $this->belongsTo(ProfileModel::class);
    }
}