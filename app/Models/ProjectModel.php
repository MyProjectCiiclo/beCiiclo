<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AuthModel;

class ProjectModel extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'language',
        'description',
        'image_url',
        'project_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(AuthModel::class, 'user_id');
    }
}
