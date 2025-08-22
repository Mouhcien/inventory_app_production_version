<?php

use App\Models\Consumable;
use App\Models\Delivery;
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
        Schema::create('stock_consumables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Delivery::class, 'delivery_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Consumable::class, 'consumable_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity_received');
            $table->integer('quantity_rest');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_consumables');
    }
};
