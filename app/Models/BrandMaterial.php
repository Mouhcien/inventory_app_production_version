<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BrandMaterial extends Model
{
    protected $fillable = [
        'title', 'logo', 'logo_data'
    ];

    function models_material(): HasMany {
        return $this->hasMany(ModelMaterial::class);
    }
}
