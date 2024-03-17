<?php

namespace App\Services;

use App\Http\Resources\ReviewsResource;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewService
{
  public function __construct(
    private ReviewRepositoryInterface $reviewRepository
  ) {

  }

  public function getReviewsFromProduct(int $id, int $items_per_page)
  {
    $reviews = $this->reviewRepository->getReviewsFromProduct($id, $items_per_page);
    return ReviewsResource::collection($reviews);
  }

}
