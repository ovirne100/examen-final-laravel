<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_iduser')->constrained('users','iduser')->onDelete('cascade');
            $table->foreignId('roles_idrole')->constrained('roles','idrole')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('roles_users');
    }
};
