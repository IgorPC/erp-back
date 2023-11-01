<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;

    protected $table = 'product_status';
    protected $fillable = [
        'description'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'status_id');
    }
}
