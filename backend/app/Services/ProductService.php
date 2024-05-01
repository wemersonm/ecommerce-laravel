<?php

namespace App\Services;


use Throwable;
use App\Traits\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use PhpParser\ErrorHandler\Collecting;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CardProductResource;
use App\Http\Resources\ProductInfoResource;
use App\Exceptions\ProductNotExistException;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    use ResponseService;
    public function __construct(
        private ProductRepositoryInterface $productRepository,
    ) {
    }

    public function getProductsOnFlashSales(): JsonResponse
    {
        try {
            if (Cache::has('flash_sales_cache')) {
                $products = json_decode(Cache::get('flash_sales_cache'));
            }
            if (!isset($products) || !$products) {
                $products = $this->productRepository->getProductsOnFlashSales();
            }
            return $this->responseSuccess(['data' => CardProductResource::collection($products)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error at get  products in flash sale', 400);
        }
    }
    public function getProductsBestSellers(int $limit): JsonResponse
    {
        try {
            if (Cache::has('best_selllers_cache')) {
                $products = json_decode(Cache::get('best_selllers_cache'));
            }
            if (!isset($products) || !$products) {
                $products = $this->productRepository->getProductsBestSellers($limit);
            }
            return $this->responseSuccess(['data' => CardProductResource::collection($products)]);

        } catch (Throwable $th) {
            return $this->responseError($th, 'error at get best sellers products', 400);
        }
    }
    public function getOurProducts(int $limit): JsonResponse
    {
        try {
            if (Cache::has('our_products_cache')) {
                $products = json_decode(Cache::get('our_products_cache'));
            }
            if (!isset($products) || !$products) {
                $products = $this->productRepository->getOurProducts($limit);
            }
            return $this->responseSuccess(['data' => CardProductResource::collection($products)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get  our-products');
        }
    }

    public function getInfoProduct(string $slug)
    {
        try {
            $user = auth()->guard('sanctum')->user();
            $product_exist = $this->productRepository->getProductBySlug($slug);
            if (!$product_exist) {
                throw new ProductNotExistException;
            }
            $product_info = $this->productRepository->getInfoProduct($product_exist, $user->id ?? null);
            return $this->responseSuccess(['data' => new ProductInfoResource($product_info)]);
        } catch (Throwable $th) {
            return $this->responseError($th, 'error when get info product');
        }
    }

}
