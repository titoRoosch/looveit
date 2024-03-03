<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Sales extends Model
{
    use HasFactory;


    public function items()
    {
        return $this->hasMany(SalesItems::class, 'sale_id');
    }
}
