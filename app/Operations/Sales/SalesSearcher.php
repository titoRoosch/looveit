<?php

namespace App\Operations\Sales;

use App\Models\Sales;

class SalesSearcher
{

    public function __construct() {

    }

    public function search($salesId = null) {

        $search = Sales::with('items.product');

        if($salesId) {
            $search->where('sales.id', $salesId);
        }

        $data = $this->formatData($search->get());

        return $data;
    }

    protected function formatData($sales) {

        $salesFormated = [];

        foreach($sales as $sale) {
            $salesFormated[] = [
                'sales_id' => $sale->id,
                'amount' => $sale->amount,
                'products' => $sale->items->map(function ($item) {
                    return [
                        'product_id' => $item->product->id,
                        'nome' => $item->product->nome,
                        'price' => $item->product->price,
                        'amount' => $item->amount
                    ];
                })
            ];
        }

        return $salesFormated;
    }

    public function searchFind($salesId) {
        $sale = Sales::find($salesId);
        return $sale;
    }
}