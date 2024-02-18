<?php

namespace App\Services;

use App\Http\Resources\CardProductResource;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Cache;

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
      if (Cache::has('flash_sales_product')) {
        $products = json_decode(Cache::get('flash_sales_product'));
      }
      return $products ?? CardProductResource::collection($this->productRepository->getFlashSalesProducts());
    } catch (\Throwable $th) {
      return $this->response(class_basename($th), 'error at searching for products flash sale', 400);
    }
  }

  public function serviceGetBestSellers(int $limit = 8)
  {
    try {
      $products = null;
      if (Cache::has('best_sellers_product')) {
        $products = json_decode(Cache::get('best_sellers_products'));
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
      if (Cache::has('our_products')) {
        $products = json_decode(Cache::get('our_products'));
      }
      return $products ?? CardProductResource::collection($this->productRepository->getOurProducts($limit));
    } catch (\Throwable $th) {
      return $this->response(class_basename($th), 'error when get products from our-products session', 400);
    }
  }
  public function serviceAddProductAtCart(array $data)
  {
    try {
      $product = $this->productRepository->findById($data['id']);
      $user = auth()->user();
      $created = $user->cart()->create([
        'product_id' => $product->id,
        'quantity' => $data['quantity'],
      ]);
      return $created ? (new AddProductAtCartResource($created)) : throw new \Exception('error add product at cart');
    } catch (\Throwable $th) {
      dd(class_basename($th));
    }
  }
  public function response(string $error, string $message, int $code = 400, $data = [])
  {
    return response()->json([
      'error' => $error,
      'message' => $message,
      'data' => !empty($data),
    ], $code);
  }


}