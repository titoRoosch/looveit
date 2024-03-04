<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class SalesItems extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'product_id', 'sale_id'];

    public function product(): belongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function sales(): belongsTo
    {
        return $this->belongsTo(Sales::class, 'sale_id');
    }
}
