<?php


namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
  public function getFlashSalesProducts();
  public function getBestSellersProducts(int $limit);
  public function getOurProducts(int $limit);

  public function findById(int $id);


}