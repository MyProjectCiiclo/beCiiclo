<?php

class ProjectModel  {
    protected $table = 'projects';


    protected $fillable = [
        'title',
        'description',
        'image_url',
        'tags',
    ];

}