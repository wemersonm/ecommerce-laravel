<?php

namespace App\Services;

use Throwable;
use App\Traits\ResponseService;
use App\Http\Resources\ReviewsResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\ReviewRepositoryInterface;

class ReviewService
{
    use ResponseService;
    public function __construct(
        private ReviewRepositoryInterface $reviewRepository
    ) {
    }

    public function getReviewsFromProduct(int $product_id, int $items_per_page)
    {
        try {
            $reviews = $this->reviewRepository->getReviewsFromProduct($product_id, $items_per_page);
            return $this->responseSuccess(['data' => ReviewsResource::collection($reviews)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get reviews from product');
        }
    }
}
