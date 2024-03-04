<?php

namespace App\Operations\Sales;

use App\Models\Sales;

class SalesCancel
{

    private $sale;

    public function __construct(Sales $sale) {
        $this->sale = $sale;
    }

    public function cancel() {

        $this->sale->status = 'canceled';
        $this->sale->update();

        return $this->sale;
    }
}