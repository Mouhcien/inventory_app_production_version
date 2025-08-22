<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Entity extends Model
{

    public function service_entity(): BelongsTo {
        return $this->belongsTo(ServiceEntity::class);
    }

    public function type_entity(): BelongsTo {
        return $this->belongsTo(TypeEntity::class);
    }

    public function secters_entities(): HasMany {
        return $this->hasMany(SecterEntity::class);
    }

    public function sections_entities(): HasMany {
        return $this->hasMany(SectionEntity::class);
    }

    public function employees(): HasMany {
        return $this->hasMany(Employee::class);
    }
}
