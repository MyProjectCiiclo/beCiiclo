<?php

namespace App\Http\Controllers;

use App\Services\RatingService;

class RatingController extends Controller
{
    protected $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    public function index()
    {
        $data = $this->ratingService->getRatings();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        $result = $this->ratingService->deleteRating($id);

        return response()->json([
            'success' => true,
            'message' => 'Rating deleted successfully',
            'data' => $result
        ]);
    }
}