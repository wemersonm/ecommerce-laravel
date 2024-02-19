<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductAtCartRequest;
use App\Services\CartService;
use Illuminate\Http\Client\Request;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService,
    ) {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return $this->cartService->serviceGetProductsInCart();
    }

    public function store(AddProductAtCartRequest $request)
    {
        $data = $request->validated();
        return $this->cartService->serviceAddProductAtCart($data);
    }

    public function destroy(Request $request)
    {
        $data = $request->validate(['id' => 'sometimes|numeric']);

    }


}
