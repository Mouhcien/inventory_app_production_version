<?php

use App\Models\Consumable;
use App\Models\Employee;
use App\Models\StockConsumable;
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
        Schema::create('consummations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StockConsumable::class, 'stock_consumable_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Employee::class, 'employee_id')->constrained()->cascadeOnDelete();
            $table->integer('quantity_required')->default(1);
            $table->date('consummation_date');
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consummations');
    }
};
