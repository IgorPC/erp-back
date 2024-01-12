<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $fillable = [
        'name',
        'code',
        'price',
        'quantity',
        'status_id',
        'created_by',
    ];

    public function productStatus()
    {
        return $this->hasOne(ProductStatus::class, 'id', 'status_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function productsSale()
    {
        return $this->hasMany(ProductSale::class, 'product_id', 'id');
    }
}
