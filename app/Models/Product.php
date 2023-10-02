<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'genre',
        'buy_price',
        'sale_price',
        'disc',
        'quantity',
        'published_date',
        'publisher',
        'cover_image_path',
    ];
}
