<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MarchMaterial extends Model
{

    function deliveries_material():HasMany {
        return $this->hasMany(DeliveryMaterial::class);
    }
}
