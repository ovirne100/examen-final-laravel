<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('carts', function (Blueprint $table) {
            $table->id('idcart');
            $table->integer('quantity')->default(1);
            $table->foreignId('users_iduser')->nullable()->constrained('users','iduser')->nullOnDelete();
            $table->foreignId('products_idproduct')->nullable()->constrained('products','idproduct')->nullOnDelete();
            $table->foreignId('services_idservice')->nullable()->constrained('services','idservice')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('carts');
    }
};
