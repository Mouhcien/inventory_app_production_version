<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelMaterial extends Model
{
    /*
    protected $fillable = [
        'title', 'image', 'image_data', 'type_material_id', 'brand_material_id'
    ];
    */

    function type_material(): BelongsTo {
        return $this->belongsTo(TypeMaterial::class);
    }

    function brand_material(): BelongsTo {
        return $this->belongsTo(BrandMaterial::class);
    }

    function deliveries_material():HasMany {
        return $this->hasMany(DeliveryMaterial::class);
    }

}
