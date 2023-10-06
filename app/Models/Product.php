<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\ProductSale;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'buy_price',
        'sale_price',
        'quantity',
        'cover_image_path',
    ];

    public function productSales()
    {
    	return $this->hasMany(ProductSale::class);
    }
}
