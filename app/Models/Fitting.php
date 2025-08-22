<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fitting extends Model
{

    public function model_material(): BelongsTo {
        return $this->belongsTo(ModelMaterial::class);
    }

    public function consumable(): BelongsTo {
        return $this->belongsTo(Consumable::class);
    }
}
