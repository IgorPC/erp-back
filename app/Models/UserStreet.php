<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStreet extends Model
{
    use HasFactory;

    protected $table = 'user_street';

    protected $fillable = [
        'user_id',
        'street',
        'number',
        'neighborhood',
        'city',
        'country',
        'zip_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
