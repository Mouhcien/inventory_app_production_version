<?php

use App\Models\MarchMaterial;
use App\Models\ModelMaterial;
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
        Schema::create('delivery_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ModelMaterial::class, 'model_material_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(MarchMaterial::class, 'march_material_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_materials');
    }
};
