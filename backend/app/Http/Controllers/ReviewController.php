<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    public function __construct(private ReviewService $reviewService)
    {

    }
    public function index(Request $request)
    {
        $data = $request->validate([
            'id' => ['required', 'numeric'],
            'items_per_page' => ['required', 'numeric', 'min:1'],
        ]);

        return $this->reviewService->getReviewsFromProduct($data['id'], $data['items_per_page']);
    }
}
