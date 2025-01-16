<?php

namespace App\ViewModels\backend;

class ProductViewModel
{
    protected $products;
    public function __construct($products)
    {
        $this->products = $products;
    }

    public function getProducts()
    {
        return $this->products;
    }
}
