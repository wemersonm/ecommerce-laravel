<?php

namespace App\Repositories\Interfaces;

interface ReviewRepositoryInterface
{
  public function getReviewsFromProduct(int $id, int $items_per_page);


}
