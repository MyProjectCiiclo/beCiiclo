<?php

namespace App\Repository;

use App\Models\CvModel;

class CvRepository
{
    protected $cvModel;

    public function __construct(CvModel $cvModel)
    {
        $this->cvModel = $cvModel;
    }

    public function getAllCv()
    {
        return $this->cvModel->all();
    }

    public function create(array $data)
    {
        return $this->cvModel->create($data);
    }
    public function findByUserId($userId)
    {
        return $this->cvModel->where('user_id', $userId)->first();
    }
    public function updateCv($id, array $data)
    {
        $cv = $this->cvModel->findOrFail($id);
        $cv->update($data);

        return $cv;
    }

    public function deleteCv($id)
    {
        $cv = $this->cvModel->findOrFail($id);
        return $cv->delete();
    }
}
