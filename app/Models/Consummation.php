<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consummation extends Model
{

    public function stock_consumable(): BelongsTo {
        return $this->belongsTo(StockConsumable::class);
    }

    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }

}
