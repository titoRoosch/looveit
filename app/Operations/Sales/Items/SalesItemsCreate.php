<?php

namespace App\Operations\Sales\Items;

use App\Models\SalesItems;
use App\Models\Sales;

class SalesItemsCreate
{

    protected $sale;

    public function __construct(Sales $sale) {

        $this->sale = $sale;
    }

    public function create(Array $items) {
        
        $saleItems = [];
        foreach($items as $item) {
            
            $saleItem = SalesItems::updateOrCreate(
                [
                    'product_id' => $item['product_id'],
                    'sale_id'    => $this->sale->id
                ],
                [
                    'quantity' => $item['quantity']
                ]
            );
            $saleItems[] = $saleItem;
        }

        return $saleItems;
    }
}