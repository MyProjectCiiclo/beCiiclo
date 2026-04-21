<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectExperiencesModel extends Model
{
    protected $table = 'project_experiences';

    protected $fillable = [
        'project_name',
        'language',
        'description',
        'image',
        'project_type',
    ];
}
