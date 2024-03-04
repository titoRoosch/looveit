<?php

namespace App\Http\Controllers;

use App\Operations\Products\ProductsSearcher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ProductsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getProducts() {

        $operation = new ProductsSearcher();
        $products = $operation->search();

        return response([
            'data' => $products,
            'message' => ''
        ], 200)->header('Content-Type', 'text/json');
    }

    public function getProductsById(Request $req) {
        $operation = new ProductsSearcher();

        $products = $operation->search($req->product_id);

        if($products == null) {
            return response([
                'data' => [],
                'message' => 'Produto não encontrado'
            ], 404)->header('Content-Type', 'text/json');
        }

        return response([
            'data' => [$products],
            'message' => ''
        ], 200)->header('Content-Type', 'text/json');
    }
}
