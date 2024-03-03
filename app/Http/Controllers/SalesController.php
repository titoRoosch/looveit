<?php

namespace App\Http\Controllers;

use App\Operations\Sales\SalesCreate;
use App\Operations\Sales\SalesUpdate;
use App\Operations\Sales\SalesSearcher;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SalesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function getSales() {

        $operation = new SalesSearcher();
        $sales = $operation->search();

        return response([
            'data' => $sales,
            'message' => ''
        ], 200)->header('Content-Type', 'text/json');
    }

    public function getSalesById(Request $req) {
        $operation = new SalesSearcher();
        $sales = $operation->search($req->sales_id);

        if($sales == null) {
            return response([
                'data' => [],
                'message' => 'Venda não encontrada'
            ], 200)->header('Content-Type', 'text/json');
        }

        return response([
            'data' => $sales,
            'message' => ''
        ], 200)->header('Content-Type', 'text/json');
    }

    public function createSale(Request $req) {
        $operation =  new SalesCreate();
        $sale = $operation->create();

        return response($sales, 200)
            ->header('Content-Type', 'text/json');
    }

    public function addItemsToSale(Request $req) {
        $operation = new SalesSearcher();
        $sale = $operation->search($req->sales_id);

        return response($sales, 200)
            ->header('Content-Type', 'text/json');
    }

    public function cancelSale(Request $req) {
        $operation = new SalesSearcher();
        $sale = $operation->search($req->sales_id);


        $operationCancel = new SalesUpdate($sale);
        $sales = $operation->search($req);

        return response($sales, 200)
            ->header('Content-Type', 'text/json');
    }
}
