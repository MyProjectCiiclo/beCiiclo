<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperienceModel extends Model
{

    protected $table = 'work_experiences';
    protected $fillable = [
        'title',
        'company',
        'description'
    ];
}
