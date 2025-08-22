<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{

    function delivery_material(): BelongsTo {
        return $this->belongsTo(DeliveryMaterial::class);
    }

    function observations_material(): HasMany {
        return $this->hasMany(ObservationMaterial::class);
    }
}
