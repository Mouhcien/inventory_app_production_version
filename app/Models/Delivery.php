<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{

    public function stocks_consumables(): HasMany {
        return $this->hasMany(StockConsumable::class);
    }
}
