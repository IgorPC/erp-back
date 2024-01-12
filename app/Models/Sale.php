<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';
    protected $fillable = [
        'client_id',
        'total',
        'discount',
        'status_id',
        'created_by',
    ];

    public function saleStatus()
    {
        return $this->hasOne(SaleStatus::class, 'id', 'status_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id', 'client_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function productsSale()
    {
        return $this->hasMany(ProductSale::class, 'sale_id', 'id');
    }
}
