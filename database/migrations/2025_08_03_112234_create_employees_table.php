<?php

use App\Models\Entity;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('ppr');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('email');
            $table->string('tel')->nullable();
            $table->foreignIdFor(ServiceEntity::class, 'service_entity_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Entity::class, 'entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SecterEntity::class, 'secter_entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SectionEntity::class, 'section_entity_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Local::class, 'local_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
