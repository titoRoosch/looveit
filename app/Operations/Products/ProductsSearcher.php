<?php

namespace App\Operations\Products;

use App\Models\Products;

class ProductsSearcher
{

    public function __construct() {

    }

    public function search($productsId = null) {

        if($productsId) {
            return Products::where('id', $productsId)->first();
        }

        return Products::get();
    }
}