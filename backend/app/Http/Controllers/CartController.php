<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductAtCartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

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
        $data = $request->validate(['id' => 'required|numeric']);
        return $this->cartService->serviceRemoveProductAtCart($data);
    }

    public function update(Request $request)
    {
        $data = $request->validate(['id' => 'required|numeric','quantity' => 'required|numeric']);
        return $this->cartService->serviceUpdateProductInCart($data);
    }

}