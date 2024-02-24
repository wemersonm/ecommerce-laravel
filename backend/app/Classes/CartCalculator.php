<?php

namespace App\Classes;

class Installment
{
  public float $value = 0.0;
  public function __construct(
    public int $parcels = 8,
    public float $forward_price = 0.0,

  ) {
    $this->value
  }

  public function value()
  {
    return $this->forward_price / $this->parcels;
  }

}


class CartCalculator
{
  // cupom e aplicado no valor total do produto, sem ser com descont
  public float $forward_price_products = 0.0;
  public float $cash_price_products = 0.0;

  public Installment $intallments;

  public function __construct(
    public $cart,
  ) {
    [$this->cash_price_products, $this->forward_price_products] = $this->calculatePriceProducts();
    $this->intallments = new Installment((float) getNumberParcels($this->forward_price_products), $this->forward_price_products);
  }


  public function calculatePriceProducts()
  {
    $this->cart->cartItem->each(function ($item) {
      $this->cash_price_products += $item->product->price * ((100 - $item->product->discount) / 100);
      $this->forward_price_products += $item->product->price;
    });

    return [$this->cash_price_products, $this->forward_price_products];

  }






}
