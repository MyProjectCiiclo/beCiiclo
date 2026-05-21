<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'education_id',
        'name'
    ];

    public function education()
    {
        return $this->belongsTo(EducationModel::class);
    }
}