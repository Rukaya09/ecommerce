<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderUpdate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='orderupdates';
    protected $fillable = [
        'order_id', 'status',
    ];

    /**
     * Get the order that owns the order update.
     */
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}