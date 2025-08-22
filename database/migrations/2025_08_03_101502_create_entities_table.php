<?php

use App\Models\ServiceEntity;
use App\Models\TypeEntity;
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
        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(ServiceEntity::class, 'service_entity_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TypeEntity::class, 'type_entity_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
