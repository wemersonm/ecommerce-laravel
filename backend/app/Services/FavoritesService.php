<?php

namespace App\Services;

use App\Exceptions\ProductNotExistException;
use App\Http\Resources\ProductFavoriteResource;
use App\Http\Resources\ToggleProductFavoriteResource;
use App\Repositories\Interfaces\FavoritesRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Throwable;

class FavoritesService
{
  public function __construct(
    private FavoritesRepositoryInterface $favoritesRepository,
    private ProductRepositoryInterface $productRepository,
  ) {
  }


  public function getAllProductFavorites()
  {
    /** @var \App\Models\User $user */
    $user = auth()->user();
    $products = $this->favoritesRepository->getAllProductFavorites($user);
    return ProductFavoriteResource::collection($products);
  }


  public function toggleProductFavorites(int $id)
  {
    /** @var \App\Models\User $user */
    try {
      $user = auth()->user();
      $product = $this->productRepository->findById($id, false);
      if (!$product)
        throw new ProductNotExistException;
      $productExistInFavorites = $this->productRepository->existInFavorites($product->id, $user);
      if ($productExistInFavorites) {
        $deleted = $this->productRepository->removeProductAtFavorites($productExistInFavorites->id, $user);
      }
      if (!$productExistInFavorites) {
        $created = $this->productRepository->addProductAtFavorites($product->id, $user);
      }
      $count = $this->productRepository->countFavorites($user);
      return new ToggleProductFavoriteResource([
        'action' => isset ($deleted) ? 'deleted' : (isset ($created) ? 'created' : $error = true),
        'success' => !isset ($error),
        'quantity' => $count,
      ]);
    } catch (Throwable $th) {
      return $this->responseError(class_basename($th), $th->getMessage(), $th->statusCode ?? 400);// phpcs:ignore
    }
  }
  public function responseError(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => $data,
    ], $code);
  }

}
