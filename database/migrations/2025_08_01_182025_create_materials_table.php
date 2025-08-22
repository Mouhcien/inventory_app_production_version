<?php

use App\Models\DeliveryMaterial;
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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('serial');
            $table->foreignIdFor(DeliveryMaterial::class, 'delivery_material_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_reform')->default(false);
            $table->integer('state')->default(1); //1:operational //-1 en Panne //-2 en casse
            $table->string('ip')->nullable();
            $table->string('inventory_number')->nullable();
            $table->boolean('is_deployed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
