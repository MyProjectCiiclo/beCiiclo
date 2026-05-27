<?php
namespace App\Repository;

use App\Models\RatingModel;

class RatingRepository
{
    public function getAll()
    {
        return RatingModel::latest()->get();
    }

    public function delete($id)
    {
        $rating = RatingModel::find($id);

        if (!$rating) {
            return null;
        }

        $rating->delete();

        return $rating;
    }
}