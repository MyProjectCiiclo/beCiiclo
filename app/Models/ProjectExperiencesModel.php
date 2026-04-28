<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProjectExperiencesModel extends Model
{
    protected $table = 'project_experiences';

    protected $fillable = [
        'project_name',
        'language',
        'description',
        'image',
        'project_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
