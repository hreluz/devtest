<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'datetime', 'price', 'seller', 'payment_method', 'vehicle_id','datetime_check_back'
    ];

    const PAYMENT_CASH = 1;
    const PAYMENT_CARD = 2;

    /**
     * Relationships
     */
    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
