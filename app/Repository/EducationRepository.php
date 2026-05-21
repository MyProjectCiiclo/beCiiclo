<?php

namespace App\Repository;

use App\Models\EducationModel;

class EducationRepository
{
    protected $educationModel;

    public function __construct(EducationModel $educationModel)
    {
        $this->educationModel = $educationModel;
    }

    public function getAll()
    {
        return $this->educationModel
            ->with('courses')
            ->get(); // ✅ bỏ where user_id
    }

    public function create(array $data)
    {
        return $this->educationModel->create($data);
    }

    public function update($id, array $data)
    {
        $education = $this->educationModel->findOrFail($id);
        $education->update($data);

        return $education->load('courses');
    }

    public function delete($id)
    {
        return $this->educationModel->destroy($id);
    }
}