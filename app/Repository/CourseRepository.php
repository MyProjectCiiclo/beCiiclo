<?php

namespace App\Repository;

use App\Models\CourseModel;

class CourseRepository
{

    protected $courseModel;

    public function __construct(CourseModel $courseModel)
    { 
        $this->courseModel = $courseModel;

    }
     public function create(array $data)
    {
        return CourseModel::create($data);
    }

    public function delete($id)
    {
        return CourseModel::destroy($id);
    }

    public function update($id, array $data)
    {
        $course = CourseModel::findOrFail($id);
        $course->update($data);

        return $course;
    }
}