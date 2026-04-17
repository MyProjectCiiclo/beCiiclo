<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroModel extends Model
{
    protected $table = 'intros';

    protected $fillable = [
        'image_url',
        'description',
    ];
}