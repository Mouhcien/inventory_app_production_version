<?php

use App\Models\Entity;
use App\Models\Local;
use App\Models\Material;
use App\Models\SecterEntity;
use App\Models\SectionEntity;
use App\Models\ServiceEntity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_photocopies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Material::class, 'material_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ServiceEntity::class, 'service_entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Entity::class, 'entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SecterEntity::class, 'secter_entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SectionEntity::class, 'section_entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Local::class, 'local_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_photocopies');
    }
};
