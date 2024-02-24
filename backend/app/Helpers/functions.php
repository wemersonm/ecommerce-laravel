<?php

if (!function_exists('getNumberParcels')) {
  function getNumberParcels($value)
  {
    $parcels = 10;
    switch (true) {
      case($value < 50):
        $parcels = 1;
        break;
      case($value >= 50 && $value < 75):
        $parcels = 2;
        break;
      case($value >= 75 && $value < 100):
        $parcels = 3;
        break;
      case($value >= 100 && $value < 125):
        $parcels = 4;
        break;
      case($value >= 125 && $value < 150):
        $parcels = 5;
        break;
      case($value >= 150 && $value < 175):
        $parcels = 6;
        break;
      case($value >= 175 && $value < 200):
        $parcels = 7;
        break;
      case($value >= 200 && $value < 225):
        $parcels = 8;
        break;
      case($value >= 225 && $value < 250):
        $parcels = 9;
        break;
    }
    return $parcels;
  }
}