<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CvModel extends Model
{
    protected $table = 'cvs';

    protected $fillable = [
        'cv',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(AuthModel::class, 'user_id', 'id');
    }

    
}