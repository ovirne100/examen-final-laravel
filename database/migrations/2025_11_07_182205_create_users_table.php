<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id('iduser');
            $table->string('name',45);
            $table->string('lastname',45)->nullable();
            $table->string('email',100)->unique();
            $table->string('country',45)->nullable();
            $table->string('phone',45)->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
