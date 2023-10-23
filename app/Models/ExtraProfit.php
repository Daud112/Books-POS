<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraProfit extends Model
{
    use HasFactory;
    protected $fillable = [
        'profit',
        'product_sales_id',
        'sale_id',
    ];
}
