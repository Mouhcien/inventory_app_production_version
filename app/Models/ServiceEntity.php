<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceEntity extends Model
{

    public function entities(): HasMany {
        return $this->hasMany(Entity::class);
    }

    public function employees(): HasMany {
        return $this->hasMany(Employee::class);
    }

}
