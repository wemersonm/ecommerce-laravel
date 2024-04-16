<?php

namespace App\Repositories\Eloquent;

use App\Models\Review;
use App\Repositories\Interfaces\ReviewRepositoryInterface;

class EloquentReviewRepository implements ReviewRepositoryInterface
{
    public function getReviewsFromProduct(int $id, int $items_per_page)
    {
        return Review::where('product_id', $id)->with(['user'])->latest()->paginate($items_per_page);
    }
}
