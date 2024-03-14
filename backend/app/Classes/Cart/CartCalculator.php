<?php

namespace App\Classes\Cart;

class CartCalculator
{
    public float $forward_price_products = 0.0;
    public float $cash_price_products = 0.0;
    public float $cash_discount_cupon = 0.0;
    public float $price_discount_cupon = 0.0;
    public float $shipping_value = 0.0;
    public float $forward_total_cart = 0.0;
    public float $cash_total_cart = 0.0;
    public Installment $installment;

    public function __construct(private object|array $products, private object|array $shipping)
    {
        [$this->cash_price_products, $this->forward_price_products] = $this->calculatePriceProducts();
        if ($shipping)
            $this->shipping_value = $shipping['price'];
        $this->calculateSumDiscountCupon($products);
        $this->calculateTotalPriceCart();
        $this->installment = new Installment($this->forward_total_cart);
    }

    private function calculatePriceProducts(): array
    {
        $this->products->each(function ($item) {
            $this->cash_price_products += $item->product->cash_price;
            $this->forward_price_products += $item->product->price;
        });
        return [(float) number_format($this->cash_price_products, 2, '.', ''), (float) number_format($this->forward_price_products, 2, '.', '')];
    }

    private function calculateSumDiscountCupon(object $products)
    {
        $discount_cupon = $products->reduce(function ($acc, $item) {
            if (isset ($item->cash_discount_cupon)) {
                $acc['cash_discount_cupon'] += $item->cash_discount_cupon;
            }
            if (isset ($item->price_discount_cupon)) {
                $acc['price_discount_cupon'] += $item->price_discount_cupon;
            }
            return $acc;
        }, ['cash_discount_cupon' => 0, 'price_discount_cupon' => 0]);

        $this->cash_discount_cupon = (float) number_format($discount_cupon['cash_discount_cupon'], 2, '.', '');
        $this->price_discount_cupon = (float) number_format($discount_cupon['price_discount_cupon'], 2, '.', '');
    }
    // 
    private function calculateTotalPriceCart()
    {
        $this->forward_total_cart = $this->forward_price_products + $this->shipping_value - $this->price_discount_cupon;
        $this->cash_total_cart = $this->cash_price_products + $this->shipping_value - $this->cash_discount_cupon;
    }




}