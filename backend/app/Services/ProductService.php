<?php

namespace App\Services;


use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CardProductResource;
use App\Exceptions\ProductNotExistException;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
  public function __construct(
    private ProductRepositoryInterface $productRepository,
  ) {

  }

  public function serviceGetFlashSales()
  {
    try {
      $products = null;
      if (Cache::has('flash_sales_cache')) {
        $products = json_decode(Cache::get('flash_sales_cache'));
      }
      return $products ?? CardProductResource::collection($this->productRepository->getFlashSalesProducts());
    } catch (\Throwable $th) {
      return $this->response(class_basename($th), 'error at searching for products flash sale', 400);
    }
  }

  public function serviceGetBestSellers(int $limit)
  {
    try {
      $products = null;
      if (Cache::has('best_selllers_cache')) {
        $products = json_decode(Cache::get('best_selllers_cache'));
      }
      return $products ?? CardProductResource::collection($this->productRepository->getBestSellersProducts($limit));
    } catch (\Throwable $th) {
      return $this->response(class_basename($th), 'error at searching for products best sellers', 400);
    }

  }

  public function serviceGetOurProducts(int $limit)
  {
    try {
      $products = null;
      if (Cache::has('our_products_cache')) {
        $products = json_decode(Cache::get('our_products_cache'));
      }
      return $products ?? CardProductResource::collection($this->productRepository->getOurProducts($limit));
    } catch (\Throwable $th) {
      return $this->response(class_basename($th), 'error when get products from our-products session', 400);
    }
  }

  public function getProduct(string $slug)
  {
    $productExist = $this->productRepository->getProductBySlug($slug);
    if (!$productExist) {
      throw new ProductNotExistException;
    }
    $infoProduct = $this->productRepository->getInfoProduct($productExist);
    return new ProductResource($infoProduct);
  }
  public function response(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => !empty ($data),
    ], $code);
  }


}