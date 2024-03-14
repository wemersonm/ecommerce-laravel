<?php


if (!function_exists('DumpDieWithPre')) {

  function DumpDieWithPre($value)
  {
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die;
  }

}