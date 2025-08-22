<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryMaterial extends Model
{

    function model_material(): BelongsTo {
        return $this->belongsTo(ModelMaterial::class);
    }

    function march_material(): BelongsTo {
        return $this->belongsTo(MarchMaterial::class);
    }

    function materials():HasMany {
        return $this->hasMany(Material::class);
    }
}
