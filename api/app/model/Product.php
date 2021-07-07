<?php

class Product
{
  public function findAll()
  {
    return [
      [
        "model" => "air max",
        "size" => [38, 39, 40, 41],
        "color" => "black",
      ],
      [
        "model" => "yeezy boost",
        "size" => [38, 39, 40, 41],
        "color" => "white",
      ],
      [
        "model" => "jordan",
        "size" => [38, 39, 40, 41],
        "color" => "red",
      ],
    ];
  }
}
