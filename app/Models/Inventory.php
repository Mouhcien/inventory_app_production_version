<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    public function material(): BelongsTo {
        return $this->belongsTo(Material::class);
    }

    public function employee(): BelongsTo {
        return $this->belongsTo(Employee::class);
    }
}
