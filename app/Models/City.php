<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{

    public function locals(): HasMany {
        return $this->hasMany(Local::class);
    }
}
