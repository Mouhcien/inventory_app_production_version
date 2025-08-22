<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consumable extends Model
{

    public function type_consumable(): BelongsTo {
        return $this->belongsTo(TypeConsumable::class);
    }

    public function fittings(): HasMany {
        return $this->hasMany(Fitting::class);
    }

    public function stocks_consumables(): HasMany {
        return $this->hasMany(StockConsumable::class);
    }
}
