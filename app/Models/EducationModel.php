<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationModel extends Model
{

    protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'school',
        'degree',
        'major',
        'start_date',
        'end_date',
        'description'
    ];

    public function courses()
    {
        return $this->hasMany(CourseModel::class, 'education_id');
    }
}
