<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Product;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'buy_price',
        'sale_price',
        'quantity',
        'product_id',
        'sale_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }
}
