<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SecterEntity extends Model
{

    public function entity(): BelongsTo {
        return $this->belongsTo(Entity::class);
    }

    public function employees(): HasMany {
        return $this->hasMany(Employee::class);
    }
}
