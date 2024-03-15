<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProduct;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;


class ProductController extends Controller
{
  public function __construct(
    private ProductService $productService
  ) {
    $this->middleware(['auth:sanctum'])->only(['favorites']);
  }
  public function getFlashSales()
  {
    return $this->productService->serviceGetFlashSales();
  }
  public function getBestSellers(Request $request)
  {
    $data = $request->validate(['limit' => ['sometimes', 'numeric']]);
    return $this->productService->serviceGetBestSellers($data['limit'] ?? 8);
  }

  public function getOurProducts(Request $request)
  {
    $data = $request->validate([
      'limit' => 'sometimes|numeric',
    ]);
    return $this->productService->serviceGetOurProducts($data['limit'] ?? 8);
  }


}
