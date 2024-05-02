<?php

namespace App\Repositories\Interfaces;

interface ReviewRepositoryInterface
{
    public function getReviewsFromProduct(int $product_id, int $items_per_page);
}
