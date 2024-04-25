<?php

namespace App\Services;

use App\Exceptions\ErrorSystem;
use Throwable;
use App\Traits\ResponseService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ProductFavoriteResource;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;

class FavoriteService
{
    use ResponseService;
    public function __construct(
        private FavoriteRepositoryInterface $favoriteRepository,
    ) {
    }
    public function getAllFavorites(): JsonResponse
    {
        try {
            $user = auth()->user();
            $products = $this->favoriteRepository->getAllFavorites($user->id);
            return $this->responseSuccess(['data' => ProductFavoriteResource::collection($products)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get favorites from user');
        }
    }
    public function addFavorite(int $product_id): JsonResponse
    {
        try {
            $user = auth()->user();
            $favorite_created = $this->favoriteRepository->createFavorite($user->id, $product_id);
            return $favorite_created ?
                $this->responseSuccess([
                    'data' => ProductFavoriteResource::collection($this->favoriteRepository->getAllFavorites($user->id)),
                    'message' => 'favorite add with success',
                ]) :
                throw new ErrorSystem;
        } catch (Throwable $th) {
            return $this->responseError($th, 'error add product at favorite');
        }
    }
    public function deleteFavorite(int $product_id): JsonResponse
    {
        try {
            $user = auth()->user();
            $favorite_deleted = $this->favoriteRepository->deleteFavorite($user->id, $product_id);
            return $favorite_deleted ?
                $this->responseSuccess([
                    'data' => ProductFavoriteResource::collection($this->favoriteRepository->getAllFavorites($user->id)),
                    'message' => 'favorite delete with success',
                ]) :
                throw new ErrorSystem;
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at delete product at favorite');
        }
    }

}
