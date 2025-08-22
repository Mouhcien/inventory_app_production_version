<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeMaterial extends Model
{
    protected $fillable = [
        'title'
    ];

    function models_material(): HasMany {
        return $this->hasMany(ModelMaterial::class);
    }
}
