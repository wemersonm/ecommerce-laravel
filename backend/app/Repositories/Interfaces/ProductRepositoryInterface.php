<?php


namespace App\Repositories\Interfaces;

use App\Models\User;

interface ProductRepositoryInterface
{
  public function getFlashSalesProducts();
  public function getBestSellersProducts(int $limit);
  public function getOurProducts(int $limit);
  public function findById(int $id, bool $modelNotFoundException);

  public function addProductAtFavorites(int $id, User $user);
  public function existInFavorites(int $id, User $user);
  public function removeProductAtFavorites(int $idFavorite, User $user);
  public function countFavorites(User $user);

}