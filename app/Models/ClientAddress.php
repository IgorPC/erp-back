<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    protected $table = 'client_address';

    protected $fillable = [
        'client_id',
        'street',
        'number',
        'neighborhood',
        'city',
        'country',
        'zip_code',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id', 'client_id');
    }
}
