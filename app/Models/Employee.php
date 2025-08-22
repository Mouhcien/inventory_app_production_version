<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    public function service_entity(): BelongsTo {
        return $this->belongsTo(ServiceEntity::class);
    }

    public function entity(): BelongsTo {
        return $this->belongsTo(Entity::class);
    }

    public function secter_entity(): BelongsTo {
        return $this->belongsTo(SecterEntity::class);
    }

    public function section_entity(): BelongsTo {
        return $this->belongsTo(SectionEntity::class);
    }

    public function local(): BelongsTo {
        return $this->belongsTo(Local::class);
    }
}
