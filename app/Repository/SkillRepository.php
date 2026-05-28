<?php

namespace App\Repository;

use App\Models\SkillModel;

class SkillRepository
{
    public function getAll()
    {
        return SkillModel::all();
    }

    public function create(array $data)
    {
        return SkillModel::create($data);
    }
    public function find($id)
    {
        return SkillModel::find($id);
    }
    public function findByName($name)
{
    return SkillModel::where('name', $name)->first();
}
    public function update($id, array $data)
    {
        $skill = SkillModel::find($id);

        if (!$skill) {
            return null;
        }

        $skill->update($data);

        return $skill;
    }

    public function delete($id)
    {
        $skill = SkillModel::find($id);

        if (!$skill) {
            return false;
        }

        return $skill->delete();
    }
}
