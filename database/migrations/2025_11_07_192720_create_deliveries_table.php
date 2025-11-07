<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('iddelivery');
            $table->string('gender',10)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('vehicle_type',50)->nullable();
            $table->string('dni_document_front')->nullable();
            $table->string('dni_document_back')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('transit_license')->nullable();
            $table->string('profile_photo')->nullable();
            $table->foreignId('users_iduser')->nullable()->constrained('users','iduser')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('deliveries');
    }
};
