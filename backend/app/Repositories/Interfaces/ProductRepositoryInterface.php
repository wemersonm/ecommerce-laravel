<?php


namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Models\User;

interface ProductRepositoryInterface
{
    public function getProductsOnFlashSales();

    public function getProductsBestSellers(int $limit);

    public function getOurProducts(int $limit);

    public function findById(int $id, bool $modelNotFoundException);

    public function getProductBySlug(string $slug);

    public function getInfoProduct(Product $product, int|null $user_id);
}
