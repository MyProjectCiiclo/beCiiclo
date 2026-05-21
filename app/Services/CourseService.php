<?php

namespace App\Services;

use App\Repository\CourseRepository;


class CourseService
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function create($data)
    {
        return $this->courseRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->courseRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->courseRepository->delete($id);
    }
}
