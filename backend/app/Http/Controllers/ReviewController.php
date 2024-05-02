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
        $request_data = $request->validate([
            'product_id' => ['required',],
            'items_per_page' => ['required', 'numeric', 'min:1','max:8'],
        ]);

        return $this->reviewService->getReviewsFromProduct($request_data['product_id'], $request_data['items_per_page']);
    }
}
