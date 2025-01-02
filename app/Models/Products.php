<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'stock',
        'rating',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function ordered_products()
    {
        return $this->hasMany(OrderedProducts::class, 'product_id');
    }
}
