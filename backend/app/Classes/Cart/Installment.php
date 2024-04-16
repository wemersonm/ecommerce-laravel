<?php

namespace App\Classes\Cart;

class Installment
{
    public int $parcels = 1;
    public float $value = 0.0;
    public function __construct(public float $forward_price = 0.0)
    {
        $this->parcels = $this->getNumberParcels($this->forward_price);
        $this->value = (float) number_format($this->value(), 2, '.', '');
    }

    public function value()
    {
        return $this->parcels != 0 ?
            $this->forward_price / $this->parcels : $this->forward_price;
    }

    private function getNumberParcels(float $value): int
    {
        $parcelMap = [
            [0, 50, 1],
            [50, 75, 2],
            [75, 100, 3],
            [100, 125, 4],
            [125, 150, 5],
            [150, 175, 6],
            [175, 200, 7],
            [200, 225, 8],
            [225, 250, 9],
        ];
        foreach ($parcelMap as $range) {
            if ($value >= $range[0] && $value < $range[1]) {
                return $range[2];
            }
        }
        return 10;
    }
}
