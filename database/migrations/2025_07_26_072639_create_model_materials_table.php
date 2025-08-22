<?php

use App\Models\BrandMaterial;
use App\Models\TypeMaterial;
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
        Schema::create('model_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->binary('image_data');
            $table->boolean('is_reform')->default(false);
            $table->foreignIdFor(TypeMaterial::class, 'type_material_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(BrandMaterial::class, 'brand_material_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_materials');
    }
};
