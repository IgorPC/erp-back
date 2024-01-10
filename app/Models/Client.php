<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'status_id',
        'created_by',
    ];

    public function clientAddress()
    {
        return $this->hasOne(ClientAddress::class, 'client_id');
    }

    public function clientStatus()
    {
        return $this->hasOne(ClientStatus::class, 'id', 'status_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
