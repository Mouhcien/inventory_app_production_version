<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeConsumable extends Model
{
    public function consumables(): HasMany {
        return $this->hasMany(Consumable::class);
    }
}
