<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockConsumable extends Model
{
    public function delivery(): BelongsTo {
        return $this->belongsTo(Delivery::class);
    }

    public function consumable(): BelongsTo {
        return $this->belongsTo(Consumable::class);
    }

    public function consummations(): HasMany {
        return $this->hasMany(Consummation::class);
    }
}
