<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RatingModel extends Model
{
    protected $table = 'ratings';
    protected $fillable = [
        'name',
        'message',
        'rating',
    ];
}