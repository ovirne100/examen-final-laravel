<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('idvehicle');
            $table->string('brand',45)->nullable();
            $table->string('model',45)->nullable();
            $table->string('year',45)->nullable();
            $table->string('plate',45)->nullable();
            $table->foreignId('deliveries_iddelivery')->nullable()->constrained('deliveries','iddelivery')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('vehicles');
    }
};
