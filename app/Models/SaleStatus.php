<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleStatus extends Model
{
    use HasFactory;

    protected $table = 'sale_status';
    protected $fillable = [
        'description'
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'status_id');
    }
}
