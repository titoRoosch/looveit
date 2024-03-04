<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesRequest;
use App\Operations\Sales\SalesCreate;
use App\Operations\Sales\SalesCancel;
use App\Operations\Sales\SalesSearcher;
use App\Operations\Sales\Items\SalesItemsCreate;
use App\Operations\Products\ProductsSearcher;
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
            ], 404)->header('Content-Type', 'text/json');
        }

        return response([
            'data' => $sales,
            'message' => ''
        ], 200)->header('Content-Type', 'text/json');
    }

    public function createSale(SalesRequest $req) {

        $validatedProducts = $this->validateProducts($req);
        if($validatedProducts == []) {
            return response([
                'data' => [],
                'message' => 'É necessário informar pelo menos 1 produto válido'
            ], 400)->header('Content-Type', 'text/json');
        }
        // Cria a Venda
        $operation =  new SalesCreate();
        $sale = $operation->create();

        // Cria os items da venda
        $operationItems  = new SalesItemsCreate($sale);
        $operationItems->create($validatedProducts);

        // altera o valor total da venda
        $operation->updateAmount($sale);

        // retorna a venda conforme o searcher
        $operation = new SalesSearcher();
        $sales = $operation->search($sale->id);

        return response([
            'data' => $sales,
            'message' => 'Venda criada com sucesso'
        ], 200)->header('Content-Type', 'text/json');
    }

    public function addItemsToSale(SalesRequest $req) {
        $operation = new SalesSearcher();
        $sale = $operation->searchFind($req->sales_id);

        if($sale == null) {
            return response([
                'data' => [],
                'message' => 'Venda não encontrada'
            ], 404)->header('Content-Type', 'text/json');
        }

        $validatedProducts = $this->validateProducts($req);
        if($validatedProducts == []) {
            return response([
                'data' => [],
                'message' => 'É necessário informar pelo menos 1 produto válido'
            ], 400)->header('Content-Type', 'text/json');
        }

        // Cria ou atualiza os items da venda
        $operationItems  = new SalesItemsCreate($sale);
        $operationItems->create($validatedProducts);

        // altera o valor total da venda
        $operationSalesCreate =  new SalesCreate();
        $operationSalesCreate->updateAmount($sale);

        // retorna a venda conforme o searcher
        $operation = new SalesSearcher();
        $sales = $operation->search($sale->id);

        return response([
            'data' => $sales,
            'message' => 'Venda atualizada com sucesso'
        ], 200)->header('Content-Type', 'text/json');
    }

    public function cancelSale(Request $req) {
        $operation = new SalesSearcher();
        $sale = $operation->searchFind($req->sales_id);


        if($sale == null) {
            return response([
                'data' => [],
                'message' => 'Venda não encontrada'
            ], 404)->header('Content-Type', 'text/json');
        }

        $operationCancel = new SalesCancel($sale);
        $sales = $operationCancel->cancel();

        return response([
            'data' => [$sales],
            'message' => 'Venda cancelada com sucesso'
        ], 200)->header('Content-Type', 'text/json');
    }

    protected function validateProducts($params) {
        if(!isset($params->products) || $params->products == []) {
            return [];
        }

        $productIds = collect($params->products)->pluck('product_id')->toArray();
        
        $operation = new ProductsSearcher();
        $existingProducts = $operation->searchByArray($productIds);

        $productsToProcess = [];

        foreach ($params->products as $product) {
            $productId = $product['product_id'];
            $quantity = $product['quantity'];

            $existingProduct = $existingProducts->where('id', $productId)->first();

            if ($existingProduct) {
                $productsToProcess[] = [
                    'product_id' => $productId,
                    'quantity' => $quantity
                ];
            }
        }

        return $productsToProcess;        
    }
    
}
