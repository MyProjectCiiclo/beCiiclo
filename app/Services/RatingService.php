<?php
namespace App\Services;

use App\Repository\RatingRepository;
class RatingService
{
    protected $ratingRepository;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function getRatings()
    {
        return $this->ratingRepository->getAll();
    }

    public function deleteRating($id)
    {
        return $this->ratingRepository->delete($id);
    }
}