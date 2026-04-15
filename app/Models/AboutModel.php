<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model
{
    protected $table = 'abouts';

    protected $fillable = [
        'design_description',
        'dev_description',
        'design_items',
        'skills',
        ];
}