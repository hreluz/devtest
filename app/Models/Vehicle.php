<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    const STATUS_AVAILABLE          = 1;
    const STATUS_BUSY               = 2;
    const STATUS_CHECKED_OUT        = 3;

    protected $fillable = [
        'name', 'brand'
    ];

    /**
     * Gets the current checkout the vehicle has, if it exists
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function getCurrentCheckoutAttribute() {
        if($this->status != self::STATUS_CHECKED_OUT || !$this->checkouts()->whereNull('datetime_check_back')->exists()){
            return null;
        }

        return $this->checkouts()->whereNull('datetime_check_back')->first();
    }

    /**
     * Relationships
     */

    public function checkouts() {
        return $this->hasMany(Checkout::class);
    }


}
