<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    const CLEAN_UP_TIME = 1;// in seconds
    const ML_PER_SECOND = 30;

    /**
     * Pump: 1s = 30ml (+-2ml)
     */


    protected $fillable = [
        'name',
        'is_active',
        'pump_no',
    ];

    /**
     * @return bool|string
     */
    public function getSwappable()
    {
        if ($this->name === 'Lemon Juice' && $this->where('name', 'Lime Juice')->first()->is_active) {
            return 'Lime Juice';
        }

        if ($this->name === 'Lime Juice' && $this->where('name', 'Lemon Juice')->first()->is_active) {
            return 'Lemon Juice';
        }

        return false;
    }
}
