<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'language',
        'description',
        'image',
        'project_type',
    ];

}