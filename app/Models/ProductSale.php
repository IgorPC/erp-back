<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $table = 'sale';
    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'discount',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'id', 'sale_id');
    }
}
