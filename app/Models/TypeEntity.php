<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEntity extends Model
{
    public function entities(): HasMany {
        return $this->hasMany(Entity::class);
    }
}
