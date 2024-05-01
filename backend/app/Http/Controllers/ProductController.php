<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {

    }
    public function getFlashSales()
    {
        return $this->productService->getProductsOnFlashSales();
    }
    public function getBestSellers(Request $request)
    {
        $data = $request->validate(['limit' => ['sometimes', 'numeric']]);
        return $this->productService->getProductsBestSellers($data['limit'] ?? 8);
    }

    public function getOurProducts(Request $request)
    {
        $data = $request->validate([
            'limit' => 'sometimes|numeric',
        ]);
        return $this->productService->getOurProducts($data['limit'] ?? 8);
    }
    public function show(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required',
        ]);
        return $this->productService->getInfoProduct($data['slug']);
    }
}
