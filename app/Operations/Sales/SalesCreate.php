<?php

namespace App\Operations\Sales;

use App\Models\Sales;
use App\Models\SalesItems;
use Illuminate\Support\Facades\DB;

class SalesCreate
{

    public function __construct() {

    }

    public function create() {
        $sale = Sales::create([
            'amount' => 0,
            'status' => 'active'
        ]);

        return $sale;
    }

    public function updateAmount(Sales $sale) {

        $total = SalesItems::join('products', 'sales_items.product_id', '=', 'products.id')
            ->where('sales_items.sale_id', $sale->id)
            ->sum(DB::raw('sales_items.quantity * products.price'));

        $sale->amount = $total;
        $sale->update();

        return $sale;

    }
}