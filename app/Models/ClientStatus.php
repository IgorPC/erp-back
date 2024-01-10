<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientStatus extends Model
{
    use HasFactory;

    protected $table = 'client_status';
    protected $fillable = [
        'description'
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'status_id');
    }
}
