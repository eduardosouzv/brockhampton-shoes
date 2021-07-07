<?php
include '../../model/Product.php';

class ProductController
{
  function findAll()
  {
    $product = new Product();
    return $product->findAll();
  }
}
