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
     * Change status of the car
     *
     * @param $status
     * @return bool|void
     */
    public function changeStatus($status) {
        if(!in_array($status, [self::STATUS_AVAILABLE, self::STATUS_BUSY, self::STATUS_CHECKED_OUT])) {
            return ;
        }

        $this->status = $status;
        return $this->save();
    }
}
