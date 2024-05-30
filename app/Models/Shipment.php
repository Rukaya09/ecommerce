<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    protected $table='shipments';
    protected $fillable = [
        'user_id',
        'full_name',
        'address_line_1',
        'city',
        'postal_code',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}